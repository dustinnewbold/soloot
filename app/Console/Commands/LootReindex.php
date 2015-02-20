<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use App\Services\Importer;

use DB;

class LootReindex extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'loot:reindex';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Remove and re-import all XML stored in the database.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	private $importer;
	public function __construct(Importer $importer)
	{
		$this->importer = $importer;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		DB::table('item_raid')->delete();
		DB::table('items')->delete();
		DB::table('member_raid')->delete();
		DB::table('raids')->delete();
		$this->info('Removed existing raids and associated items and members');

		$xmlHistory = DB::table('xml')->get();
		foreach ( $xmlHistory as $xml ) {
			$this->info('Importing XML from ' . $xml->created_at . ' (' . $xml->checksum . ')');
			$this->importer->import($xml->xml);
		}
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
