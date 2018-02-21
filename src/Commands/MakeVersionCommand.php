<?php

namespace Eihen\Devlog\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

class MakeVersionCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'devlog:version';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the Version model if it does not exists';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Version model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/version.stub';
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getNameInput()
    {
        return Config::get('devlog.versions.model', 'Version');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace;
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
}
