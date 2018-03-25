<?php
// namespace model;

class DatabaseAdapter {
	private $server = 'localhost';
	private $username = 'root';
	private $password = '';
	private $dbname = 'l5lab';
	public $conn = null;

	public $perpage = 100;
	public $total_count;
	public $total_pages;
	public $cur_page;

	public $sort_str;

	public function __construct() {
		//initialize the connection
		try {
		    $this->conn = new PDO("mysql:host=$this->server;dbname=$this->dbname", $this->username, $this->password);
		    // set the PDO error mode to exception
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e) {
		    echo "Connection failed: " . $e->getMessage();exit;
		}
		return $this;
	}	
	
	public function sort($field, $type) {
		switch($type) {
			 case 'desc':
			 	$this->sort_str = sprintf(' order by %s desc ', $field);
			 break;
			 case 'asc':
			 	$this->sort_str = sprintf(' order by %s asc ', $field);
			 break;
			 default: 
			 break;
		}
	}
}
?>