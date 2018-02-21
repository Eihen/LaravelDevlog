<?php

namespace Eihen\Devlog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class NewChangeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:new-change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new change for the next version';

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
            if ($this->confirm('No pending version found, do you wish to create one now?')) {
                $this->call('devlog:new-version');
            } else {
                return;
            }
        }

        $version = json_decode(file_get_contents(Config::get('devlog.next_version_file')));
        do {
            $version->changes[] = $this->ask('Describe the change');
        } while ($this->confirm('Add another change?', true));

        file_put_contents(Config::get('devlog.next_version_file'), json_encode($version));
        $this->info('Change(s) created.');
    }
}
