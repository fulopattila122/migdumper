<?php

namespace Doctrine\DBAL\Migrations;

use Doctrine\DBAL\Connection;

abstract class AbstractMigration
{
	protected $sql;

	public $connection;

	public function __construct()
	{
		$this->sql = '';
		$this->connection = new Connection($this);
	}

	public function addSql($sql)
	{
		$this->sql .= "$sql;\n";
	}

	public function getSql()
	{
		return $this->sql . "\n\n" . $this->getInsertVersionSql();
	}

	public function abortIf($condition, $message = null)
	{
		// Just ignore it		
	}

	private function getInsertVersionSql()
	{
		return sprintf(
			"INSERT INTO migration_versions (version) VALUES('%s');\n",
			str_replace('Version', '', end(explode('\\', get_class($this))))
		);	
	}
}