<?php

namespace App\Contracts\Traits;

trait ProjectCommandGeneratorTrait
{
    protected function checkNameContainsPath(string $name)
    {
        if (str_contains($name, '/') === true) {
            return true;
        }
        if (str_contains($name, "\\") === true) {
            return true;
        }
        return false;
    }
    protected function getSubNamespace(string $name)
    {
        $subNamespace = '';
        if (str_contains($name, '/') === true) {

            $nameParts = explode('/', $name);
            $subNamespace = $nameParts[count($nameParts) - 2];
        }
        if (str_contains($name, "\\") === true) {
            $nameParts = explode('\\', $name);
            $subNamespace = $nameParts[count($nameParts) - 2];
        }
        return $subNamespace;
    }
    protected function getCorrectName(string $name)
    {
        $correctName = $name;

        if (str_contains($name, '/') === true) {

            $nameParts = explode('/', $name);
            $correctName = $nameParts[count($nameParts) - 1];
        }
        if (str_contains($name, "\\") === true) {
            $nameParts = explode('\\', $name);
            $correctName = $nameParts[count($nameParts) - 1];
        }
        return $correctName;
    }
}
