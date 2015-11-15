<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class APIKeyGenerateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'api:key_generate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Will generate a fresh API key for a given Shop';

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
		//

		$shop_id = $this->argument('shop');
		if(!$shop_id) return $this->error('You must provide a shop ID.');

		$shop = Shop::where('id', $shop_id)->first();
		if(!$shop) return $this->error('The shop ID you provided is invalid.');

		$access_title = $this->argument('access_title');
		if(!$access_title) $access_title = 'Free';

		$accessLevel = AccessLevel::where('title', $access_title)->first();
		if(!$accessLevel) return $this->error('The access level you provided is invalid.');

		$apiKey = new ApiKey;
		$apiKey->shop_id = $shop_id;
		$apiKey->public_key = Hash::make($shop_id . 'REMEDY');
		$apiKey->access_level_id = $accessLevel->id;
		$apiKey->save();


		$this->info('The generated API key is:');
		return $this->info($apiKey->public_key);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('shop', InputOption::VALUE_REQUIRED, 'Shop ID'),
			array('access_title', InputOption::VALUE_OPTIONAL, 'Access Level Title'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
