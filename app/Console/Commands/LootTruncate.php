<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use DB;

class LootTruncate extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'loot:truncate';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Truncate all the databases.';

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
		DB::table('bosses')->delete();
		DB::table('classes')->delete();
		DB::table('difficulties')->delete();
		DB::table('item_raid')->delete();
		DB::table('items')->delete();
		DB::table('member_raid')->delete();
		DB::table('members')->delete();
		DB::table('options')->delete();
		DB::table('races')->delete();
		DB::table('raids')->delete();
		DB::table('zones')->delete();

		$this->info('Truncated all tables');
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
