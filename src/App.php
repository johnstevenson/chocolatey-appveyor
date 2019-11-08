<?php

namespace Choco;

class App
{
    public function run()
    {
        echo PHP_EOL;
        echo 'PHP version: ',  PHP_VERSION, PHP_EOL;

        if (defined('PHP_BINARY')) {
            $binary = PHP_BINARY;
        } else {
            $binary = 'not available in this version';
        }

        echo 'PHP binary: ', $binary, PHP_EOL;
        echo PHP_EOL;
        echo passthru('composer --version');
        echo 'composer.phar: ', passthru('where composer.phar'), PHP_EOL;
        echo PHP_EOL;
        echo 'COMPOSER_HOME: ', getenv('COMPOSER_HOME'), PHP_EOL;
        echo 'composer data dir: ', exec('composer config data-dir'), PHP_EOL;
        echo 'composer cache dir: ', exec('composer config cache-dir'), PHP_EOL;
        echo PHP_EOL;
        echo 'APPVEYOR_BUILD_FOLDER: ', getenv('APPVEYOR_BUILD_FOLDER'), PHP_EOL;
        echo PHP_EOL;
    }
}
