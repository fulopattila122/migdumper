<?php

namespace App;

use Illuminate\Console\Command;
use Doctrine\DBAL\Schema\Schema;

class DumpMigrationsCommand extends Command
{
	const ns = '\\SevenSenders\\AnalyticsCommonBundle\\DoctrineMigrations\\Analytics\\';
	protected $signature = 'do {file}';

    protected $description = 'Dumps SQL from migration classes';

    public function handle()
    {
    	$this->loadFile($this->argument('file'));
    	$class = self::ns . $this->getClassName($this->argument('file'));

    	$migration = new $class();
    	$migration->up(new Schema());

        $this->info($migration->getSql());
    }

    protected function loadFile($fileName)
    {
    	include($fileName);
    }

    protected function getClassName($fileName)
    {
    	return str_replace('.php', '', end(explode('/', $fileName)));
    }
}
