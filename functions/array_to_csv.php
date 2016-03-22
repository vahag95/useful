<?php
/*header inputs*/
$csv_fields=array();
		
		$csv_fields[] = 'Campaign';
		$csv_fields[] = 'Widget';
		$csv_fields[] = 'Name';
		$csv_fields[] = 'Email';
		$csv_fields[] = 'Phone';
		$csv_fields[] = 'Youtube Url';

		$messages = $messageService->getAllMessagesForExport();
		$messages = $messages->toArray();
		File::delete('file'.\Auth::id().'.csv');		
		$fp = fopen('file'.\Auth::id().'.csv', 'x');
		// $fp = fopen('file.csv', 'w');
		fputcsv($fp, $csv_fields);

		foreach ( $messages as $fields ) {
			unset($fields['id']);
			unset($fields['user_id']);
			unset($fields['is_complete']);
			unset($fields['is_readed']);
			unset($fields['file_name']);
			unset($fields['created_at']);
			unset($fields['updated_at']);
			unset($fields['url']);
			unset($fields['user_ip']);
			unset($fields['consent']);
			unset($fields['duration']);
			unset($fields['file_type']);

			if( null !== $widgetService->getWidgetByID( $fields['widget_id'] )){
				$fields['widget_id'] = $widgetService->getWidgetByID( $fields['widget_id'] )->widget_name;
			}
			if( null !== $campaignService->getCampaignByID( $fields['campaign_id'] )) {
				$fields['campaign_id'] = $campaignService->getCampaignByID( $fields['campaign_id'] )->name;
			}
			if( $fields['widget_id'] !== '0' && $fields['campaign_id'] !== '0'  ){
			    fputcsv($fp, $fields);
			}

		}

		fclose($fp);
		// return  \Response::download( '/uploads/file'.\Auth::id().'.csv' );
		return  \Response::download( 'file'.\Auth::id().'.csv' );