<?php

namespace Manager;

use PDO;//car on va creer plus bas un objet PDO
use Config;

class PDOManager
{
	private static $instance = NULL;
	
	private function __construct(){}
	private function __clone(){}
	
	public static function getInstance(){
		if(!self::$instance){
			self::$instance = new self;
		}
		return self::$instance;	
	}
// De 8 à 20 c'est ce qui fait mon  singleton	
	
	public function getPdo(){
		
		require_once __DIR__ . '/../../app/Config.php';
		$config = new Config;
		$connect = $config -> getParametersConnect();
		// On instancie un objet de la classe config, qui a pour mission de nous transmettre les infos de connexion via la fonction getParametersConfig().
		
		return new PDO('mysql:host=' . $connect['host'] . ';dbname=' . $connect['dbname'], $connect['login'], $connect['password'], array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
		PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8',
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		));
	}
}
