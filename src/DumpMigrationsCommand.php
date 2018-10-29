<?php

namespace App;

use Illuminate\Console\Command;
use Doctrine\DBAL\Schema\Schema;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DumpMigrationsCommand extends Command
{
	const ns = '\\SevenSenders\\AnalyticsCommonBundle\\DoctrineMigrations\\Analytics\\';

	protected $signature = 'do {file}';

    protected $description = 'Dumps SQL from migration classes';

    public function handle()
    {
    	$class = self::ns . $this->getClassName($this->argument('file'));

    	$migration = new $class();
    	$migration->up(new Schema());

        $this->info($migration->getSql());
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $dirname = dirname($this->argument('file'));

        spl_autoload_register(function ($class) use ($dirname) {
            $check = starts_with('\\', $class) ? $class : '\\' . $class;
            if (starts_with($check, self::ns)) {
                include "$dirname/" . class_basename($class) . '.php';
            }
        });
    }

    protected function getClassName($fileName)
    {
        $parts = explode('/', $fileName);

    	return str_replace('.php', '', end($parts));
    }
}
