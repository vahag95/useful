<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EmailTemplateSeeder extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */	
	protected $name = 'emailTemplateSeed';	

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{		
        $templates = $this->option('emailTemplates');               
        foreach ($templates as $key => $value) {        	
        	$this->emailtemplate->create($value->toArray());
        }        
	}

	/**
    * Get the console command options.
    *
    * @return array
    */
    protected function getOptions()
    {
        return array(
            array('emailTemplates', null, InputOption::VALUE_OPTIONAL, 'Email Templates.', []),
        );
    }

}

// for call command 
Artisan::call('emailTemplateSeed', [ '--emailTemplates' => $emailTemplates ]);