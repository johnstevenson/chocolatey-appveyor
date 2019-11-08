<?php

namespace Choco;

class App
{
    public function run()
    {
        echo PHP_EOL;
        $this->showPhpCiEnvironment();

        $this->output('PHP version', PHP_VERSION);

        if (defined('PHP_BINARY')) {
            $binary = PHP_BINARY;
        } else {
            $binary = 'not available in this version';
        }

        $this->output('PHP binary', $binary, true);

        $this->output(null, exec('composer --version'));
        $this->output('composer.phar', exec('where composer.phar'), true);

        $this->output('COMPOSER_HOME', getenv('COMPOSER_HOME'));
        $this->output('composer data dir', exec('composer config data-dir'));
        $this->output('composer cache dir', exec('composer config cache-dir'), true);

        $this->showAppveyorEnvironment();
    }

    private function output($name, $value, $break = false)
    {
        $format = $name !== null ? '%s: %s%s' : '%s%s%s';
        $eol = PHP_EOL . ($break ? PHP_EOL : '');
        printf($format, $name, trim($value), $eol);
    }

    private function showAppveyorEnvironment()
    {
        if (PHP_VERSION_ID >= 70100) {
            $envars = getenv();
        } else {
            $envars = array('APPVEYOR_BUILD_FOLDER' => getenv('APPVEYOR_BUILD_FOLDER'));
        }

        $env = array();

        foreach ($envars as $name => $value) {
            if (stripos($name, 'APPVEYOR') === 0) {
                $env[$name] = $value;
            }
        }

        $this->outputEnvironment($env);
    }

    private function showPhpCiEnvironment()
    {
        $names = array('PHPCI_CACHE', 'PHPCI_COMPOSER', 'PHPCI_PHP', 'PHPCI_CHOCO_VERSION');
        $env = array();

        foreach ($names as $name) {
            $env[$name] = getenv($name);
        }
        $this->outputEnvironment($env);
    }

    private function outputEnvironment(array $env)
    {
        foreach ($env as $name => $value) {
            $this->output($name, $value);
        }

        if (!empty($env)) {
            echo PHP_EOL;
        }
    }
}
