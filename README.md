# Doctrine Migration Dumper

Sometimes you can't run Doctrine Migrations and they're too big to be copy pasted.

Using this command you can drop your Doctrine migration files to a folder and get their SQL to the output.

> Hey, this is very simple, only supports `addSql()` method

## Installation

1. Get this repo
2. `composer install`

Usage:

1. Copy your Doctrine migrations file(s) in the `migrations/` folder eg. `Version20180517154808.php`
2. Run `./dump do migrations/Version20180517154808.php`
3. Get the output
4. Enjoy
