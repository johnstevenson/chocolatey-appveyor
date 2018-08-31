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
        echo passthru('composer --version');
        echo 'composer cache dir: ', exec('composer config cache-dir'), PHP_EOL;
        echo 'composer data dir: ', exec('composer config data-dir'), PHP_EOL;
        echo PHP_EOL;
    }
}
