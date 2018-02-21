<?php

namespace Eihen\Devlog\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup migration and models for Laravel Devlog';

    /**
     * Commands to call with their description.
     *
     * @var array
     */
    protected $calls = [
        'devlog:migration' => 'Creating migration',
        'devlog:version' => 'Creating Version model',
        'devlog:change' => 'Creating Change model'
    ];

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
        foreach ($this->calls as $command => $info) {
            $this->line(PHP_EOL . $info);
            $this->call($command);
        }
    }
}
