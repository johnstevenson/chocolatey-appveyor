<?php

namespace Choco;

class App
{
    public function run()
    {
        echo PHP_EOL;
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

        if (PHP_VERSION_ID >= 70100) {
            $env = getenv();
        } else {
            $env = array('APPVEYOR_BUILD_FOLDER' => getenv('APPVEYOR_BUILD_FOLDER'));
        }

        foreach (getenv() as $name => $value) {
            if (stripos($name, 'APPVEYOR') === 0) {
                $this->output($name, $value);
            }
        }

        echo PHP_EOL;
    }

    private function output($name, $value, $break = false)
    {
        $format = $name !== null ? '%s: %s%s' : '%s%s%s';
        $eol = PHP_EOL . ($break ? PHP_EOL : '');
        printf($format, $name, trim($value), $eol);
    }
}
