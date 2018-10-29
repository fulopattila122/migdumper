<?php

namespace Doctrine\DBAL;

use Doctrine\DBAL\Platforms\MySqlPlatform;

class Connection
{
	protected $migration;
	
	public function __construct($migration)
	{
		$this->migration = $migration;
	}

	public function executeQuery($sql)
	{
		$this->migration->addSql($sql);
	}

	public function getDatabasePlatform()
	{
		return new MySqlPlatform();
	}
}