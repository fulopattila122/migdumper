<?php

namespace Doctrine\DBAL;

use Doctrine\DBAL\Platforms\MySqlPlatform;

class Connection
{
	public function getDatabasePlatform()
	{
		return new MySqlPlatform();
	}
}