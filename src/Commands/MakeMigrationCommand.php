<?php

namespace Eihen\Devlog\Commands;

use Eihen\Devlog\Helpers\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MakeMigrationCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the migration for the Devlog tables';

    /**
     * Suffix of the migration name.
     *
     * @var string
     */
    protected $migrationSuffix = 'devlog_setup_tables';

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
        $this->laravel->view->addNamespace('devlog', substr(__DIR__, 0, -8) . 'views');

        // Check for existing migrations that are possible from devlog
        $matcher = glob(Helper::getMigrationPath($this->migrationSuffix, '*'));

        $matchedFiles = array_map(function ($path) {
            return basename($path);
        }, $matcher);

        if ($matchedFiles) {
            if (count($matchedFiles) > 1) {
                $base = "Looks like migrations from Devlog already exists.\nThe following files were found: ";
            } else {
                $base = "Looks like a migration from Devlog already exists.\nThe following file was found: ";
            }

            $this->warn($base . array_reduce($matchedFiles, function ($carry, $fileName) {
                    return $carry . "\n - " . $fileName;
                }));
            if (!$this->confirm("Proceed with the migration creation?", false)) {
                return;
            }
        }

        // Create the migration
        $migration = $this->laravel->view
            ->make('devlog::tables_migration')
            ->with(['devlog' => Config::get('devlog')])
            ->render();

        $migrationPath = Helper::getMigrationPath($this->migrationSuffix);

        if (!file_exists($migrationPath) && $fs = fopen($migrationPath, 'w')) {
            fwrite($fs, $migration);
            fclose($fs);
            $this->info('Migration created successfully.');
        } else {
            $this->error("Couldn't create the migration.\n"
                . "Check the write permissions within the database/migrations directory.");
        }
    }
}
