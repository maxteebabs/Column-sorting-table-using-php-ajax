<?php
// namespace model;
include('DatabaseAdapter.php');

class Record extends DatabaseAdapter{
	public $id;
	public $firstName;
	public $lastName;
	public $email;
	public $phone;
	public $company;
	public $cur_page;

	public function __construct($page) {
		parent::__construct();
		$this->cur_page = $page;
	}
	protected function getTable() {
		return 'records';
	}
	public function create() {
		$stmt = $this->conn->prepare("INSERT INTO ".$this->getTable()." (
			id, firstName,lastName,email, phone, company
		) values (:id, :first, :last, :email, :phone, :company)");
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':first', $this->firstName);
		$stmt->bindParam(':last', $this->lastName);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':phone', $this->phone);
		$stmt->bindParam(':company', $this->company);
		$stmt->execute();
	}
	public function delete($row) {
		$sql = sprintf('delete from %s where id = "%s"', $this->getTable(), $row);
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
	}
	
	public function findAll($where_arr = array()) {
		if(!isset($this->cur_page)) {
			$this->cur_page = 1;
		}
		$start = ($this->cur_page * $this->perpage) - $this->perpage;

		//get the total num of rows;
		$where = "";
		if(count($where_arr) > 0) {
			$where = ' where '.implode("=", $where_arr);
		}
		$sort = "";
		if($this->sort_str) {
			$sort = $this->sort_str;
		}
		$sql = sprintf("SELECT * FROM records %s %s LIMIT %d, %d", $where, $sort, $start, $this->perpage);
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
}