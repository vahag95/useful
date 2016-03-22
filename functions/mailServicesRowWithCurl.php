public function createSubscriberRow( WidgetServiceInterface $widgetService , MessageServiceInterface $messageService, Request $request )
	{
		$inputs      = $request->all();
		$fields      = $request->all();
		unset( $fields['token'] );
		unset( $fields['id'] );
		unset( $fields['file_name'] );
		unset( $fields['file_type'] );
		unset( $fields['is_complete'] );
		unset( $fields['duration'] );

		$token   	 = $request->get('token');
		$widget 	 = $widgetService->getAllWidgets()->where('token_field', $token)->first();
		$inputs['user_id'] 	 = $widget->user_id;
		$form_action = $widget->rawhtml_form_action;
		$form_params = substr( $form_action, strrpos( $form_action , '?' ) +1 );
		if( substr( $form_action, 0 , strrpos( $form_action , '?' ) ) )
		{
			$form_action = substr( $form_action, 0 , strrpos( $form_action , '?' ) );
		}
		
		$postvars = '';
		foreach($fields as $key=>$value) {
		    $postvars .= $key . "=" . $value . "&";
		}
		if( $form_params )
		{
			$postvars = $postvars.$form_params;
		}else{
			$postvars = rtrim($postvars, '&');
		}
		try {
		    $ch = curl_init();

		    if (FALSE === $ch)
		        throw new Exception('failed to initialize');
		    curl_setopt( $ch, CURLOPT_HEADER, 0 );
		    // dd( $form_action , $postvars );
		    if( false === strpos( $form_action , 'http' ) ){
		    	curl_setopt( $ch, CURLOPT_URL, 'http:'.$form_action );
		    }else{
		    	curl_setopt( $ch, CURLOPT_URL, $form_action );
		    }
		    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		    curl_setopt( $ch, CURLOPT_POST, true );
    		curl_setopt( $ch, CURLOPT_POSTFIELDS, $postvars );
		    $content = curl_exec($ch);
    		// $server_output = curl_exec ($ch);


		    if (FALSE === $content)
		    	// return 'something went wrong' ;
		        throw new Exception(curl_error($ch), curl_errno($ch));

		    // ...process $content now
		} catch(Exception $e) {
			// return 'something went wrong' ;
		    trigger_error(sprintf(
		        'Curl failed with error #%d: %s',
		        $e->getCode(), $e->getMessage()),
		        E_USER_ERROR);

		}
    	
    	curl_close ($ch);

		if ( $content == true ) {
			 if( $this->updateMessage( $inputs ) )
			 {
			 	return view('widgets.templates.popups.design1.step12', ['show' => 1]);
			 }
		} else { 
			return 'something went wrong' ;
		}		
	}