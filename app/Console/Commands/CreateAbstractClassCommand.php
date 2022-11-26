<?php

namespace App\Console\Commands;

use App\Contracts\Traits\ProjectCommandGeneratorTrait;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class CreateAbstractClassCommand extends GeneratorCommand
{
    use ProjectCommandGeneratorTrait;

    protected $signature = 'make:abstract {name}';
    protected $description = 'Creating some abstract class in folder App/Contrats/AbstractClasses';
    protected $className;

    public function handle()
    {
        $this->className = $this->argument('name');
        parent::handle();
    }

    protected function replaceClass($stub, $name)
    {
        $correctName = $this->getCorrectName($this->className);
        if ($this->checkNameContainsPath($this->className)) {
            $this->replaceNamespace($stub, $this->getDefaultName() . '\\' . $this->getSubNamespace($this->className));
        }
        $stub = parent::replaceClass($stub, $correctName);
        return str_replace('Template', $correctName, $stub);
    }
    protected function getStub()
    {
        return __DIR__ . '\stubs\AbstractClass.stub';
    }
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contracts\AbstractClasses';
    }
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class.'],
        ];
    }
}
