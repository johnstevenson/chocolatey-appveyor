<?php

namespace Choco;

class App
{
    public function run()
    {
        echo 'PHP version ',  PHP_VERSION, PHP_EOL;
        echo passthru('composer --version'), PHP_EOL;
    }
}
