<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class LootPublish extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'loot:publish';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		$this->info('Copying CSS directory into public_html/soloot/css');
		\File::copyDirectory(public_path() . '/css', base_path() . '/../public_html/soloot/css');
		$this->info('Copying JavaScript directory into public_html/soloot/js');
		\File::copyDirectory(public_path() . '/js', base_path() . '/../public_html/soloot/js');

		$this->info('Clearing cache');
		$this->call('cache:clear');

		$this->info('Caching configuration');
		$this->call('config:cache');

		$this->info('-- Done publishing what needs to be published! --');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
	}

}
