<?php
namespace frontier\ploball\database;

use PDO;
use Dotenv\Dotenv;

class Database_Connection {

	/**
	 * Connect to the database.
	 *
	 * @return object
	 */
	public static function connect():object {
		$root_dir = dirname( __DIR__, 3 );
		$dotenv   = Dotenv::createImmutable( $root_dir );
		$dotenv->load();

		$dbh = new PDO( 'mysql:host=' . $_ENV['HOST'] . ';dbname=' . $_ENV['DATABASE'] . ';', $_ENV['USERNAME'], $_ENV['PASSWORD'] );
		return $dbh;
	}
}
