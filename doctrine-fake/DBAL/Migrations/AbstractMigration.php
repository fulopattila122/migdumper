<?php

namespace Doctrine\DBAL\Migrations;

abstract class AbstractMigration
{
	protected $sql;

	public function __contstruct()
	{
		$this->sql = '';
	}

	public function addSql($sql)
	{
		$this->sql .= "$sql;\n";
	}

	public function getSql()
	{
		return $this->sql . "\n\n" . $this->getInsertVersionSql();
	}

	private function getInsertVersionSql()
	{
		return sprintf(
			"INSERT INTO migration_versions (version) VALUES('%s');\n",
			str_replace('Version', '', end(explode('\\', get_class($this))))
		);	
	}
}