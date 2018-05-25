<?php

namespace App;

use Illuminate\Console\Command;

class DumpMigrationsCommand extends Command
{
	protected $signature = 'do';

    protected $description = 'Dumps SQL from migration classes';

    public function handle()
    {
        $this->info('Hello world!');
    }	
}
