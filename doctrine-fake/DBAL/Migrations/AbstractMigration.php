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

	public function addSql(string $sql, array $params = [], array $types = [])
	{
		if (!empty($params)) {
			$paramNames = array_map(function($item) {
				return ":$item";
			}, array_keys($params));

			$quotedParamValues = array_map(function($item) {
				$value = is_string($item) ? '"' . $item . '"' : $item;

				return is_null($value) ? 'NULL' : $value;
			}, $params);

			$sql = str_replace($paramNames, $quotedParamValues, $sql);
		}

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
		$parts = explode('\\', get_class($this));
		
		return sprintf(
			"INSERT INTO migration_versions (version) VALUES('%s');\n",
			str_replace('Version', '', end($parts))
		);	
	}
}