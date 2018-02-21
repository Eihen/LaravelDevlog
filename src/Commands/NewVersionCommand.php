<?php

namespace Eihen\Devlog\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use stdClass;

class NewVersionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:new-version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update the information of the next version';

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
        if (file_exists(Config::get('devlog.next_version_file'))) {
            $this->warn('There\'s already a pending version.');
            $this->warn('The data of that version will be updated.');

            if ($fs = fopen(Config::get('devlog.next_version_file'), 'r')) {
                $version = json_decode(fread($fs, filesize(Config::get('devlog.next_version_file'))));
                fclose($fs);
            } else {
                $this->error("Couldn't read the next version file.\n"
                    . 'Check the read permissions within the defined directory.');
                return;
            }
        } else {
            $version = new StdClass;
        }

        $this->info('Enter the version information');
        $version->id = $this->ask('ID (blank for auto)', false);
        $version->code = $this->ask('Version Code');
        $version->description = $this->ask('Description', false);
        if (!isset($version->changes)) {
            $version->changes = [];
        }

        if ($fs = fopen(Config::get('devlog.next_version_file'), 'w')) {
            fwrite($fs, json_encode($version));
            fclose($fs);
            $this->info('Pending version created.');

            if ($this->confirm('Do you wish to add changes to that version now?', false)) {
                $this->call('devlog:new-change');
            }
        } else {
            $this->error("Couldn't create the next version file.\n"
                . 'Check the write permissions within the defined directory.');
        }
    }
}
