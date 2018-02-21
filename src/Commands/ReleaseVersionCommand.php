<?php

namespace Eihen\Devlog\Commands;

use Eihen\Devlog\Helpers\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class ReleaseVersionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:release';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the migration for the pending version release.';

    /**
     * Suffix of the migration name.
     *
     * @var string
     */
    protected $migrationSuffix = 'devlog_version';

    /**
     * Create a new command instance
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
     * @return void
     */
    public function handle()
    {
        if (!file_exists(Config::get('devlog.next_version_file'))) {
            $this->error('No peding version found. Create a new one with \'devlog:new-version\'');
            return;
        }

        $this->laravel->view->addNamespace('devlog', substr(__DIR__, 0, -8) . 'views');

        $version = json_decode(file_get_contents(Config::get('devlog.next_version_file')));

        $version->release_date = $this->ask('Enter the version release date', date('Y-m-d'));
        $version->timestamp = date('YmdHis');

        // Create the migration
        $migration = $this->laravel->view
            ->make('devlog::version_migration')
            ->with([
                'version' => $version,
                'devlog' => Config::get('devlog')
            ])->render();

        if ($fs = fopen(Helper::getMigrationPath($this->migrationSuffix . $version->timestamp), 'w')) {
            fwrite($fs, $migration);
            fclose($fs);
            unlink(Config::get('devlog.next_version_file'));
            $this->info('Migration created successfully.');
        } else {
            $this->error("Couldn't create the migration.\n"
                . "Check the write permissions within the database/migrations directory.");
        }
    }
}
