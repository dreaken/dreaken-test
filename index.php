<?php

/**
 * Class test
 */
class test
{
	/**
	 * @var array Data from db.
	 */
	private $_dbData = [];

	/**
	 * @var array Data from file.
	 */
	private $_fileData = [];

	/**
	 * Loads data from db.
	 *
	 * @param string $dbHostname Host name
	 * @param string $dbName     DB name
	 * @param string $dbUsername DB username
	 * @param string $dbPassword DB password
	 *
	 * @return void
	 */
	public function loadInternalData(string $dbHostname, string $dbName, string $dbUsername, string $dbPassword): void
	{
		$link = $this->_connectToDb($dbHostname, $dbName, $dbUsername, $dbPassword);
		$query = $link->query("select * from my_data");
		if ($loaded = $query->fetch_all())
		{
			$this->_dbData = $loaded;
		}
	}

	/**
	 * Connect to DB.
	 *
	 * @param string $dbHostname Host name
	 * @param string $dbName     DB name
	 * @param string $dbUsername DB username
	 * @param string $dbPassword DB password
	 *
	 * @return mysqli
	 */
	private function _connectToDb($dbHostname, $dbName, $dbUsername, $dbPassword): mysqli
	{
		$link = mysqli_connect($dbHostname, $dbUsername, $dbPassword, $dbName);
		if ( ! $link)
		{
			die('blad polaczenia z baza');
		}
		return $link;
	}

	/**
	 * Loads data from file
	 *
	 * @param $jsonDataFilePath Json file
	 *
	 * @return void
	 */
	public function loadExternalData($jsonDataFilePath): void
	{
		$fileContent = file_get_contents($jsonDataFilePath);
		$this->_fileData = json_decode($fileContent, True);
	}

	/**
	 * Compares data from DB and Data from file.
	 *
	 * @return void
	 */
	public function check(): void
	{
		foreach ($this->_dbData as $item)
		{
			foreach ($this->_fileData as $secondItem)
			{
				if ($item[0] == $secondItem['id'])
				{
					echo $item[0] . "<br />" . PHP_EOL;

					break;
				}
			}
		}
	}
}

require_once 'vendor/autoload.php';

$bench = new Ubench;
$bench->start();
$test = new test();

$test->loadInternalData("sprift-db", "sprift", "sprift", "sprift2PsX");
$test->loadExternalData("data.json");
$test->check();
$bench->end();

echo $bench->getTime();

