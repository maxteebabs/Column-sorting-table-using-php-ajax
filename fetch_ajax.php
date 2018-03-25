<?php
// namespace model;
include('model/Record.php');

class AjaxCall{
	public function redirect() {
		if(isset($_POST['type'])){
			$type = $_POST['type'];
			switch ($type) {
				case 'search':
					$value = $_POST['field'];
					$column = $_POST['category'];
					$this->search($value, $column);
					break;
				case 'sort':
					$field = $_POST['field'];
					$sort_type = $_POST['sort_type'];
					$this->sort($field, $sort_type);
				break;
				case 'deleteRow':
					$row = $_POST['row'];
					$this->deleteRow($row);
				break;
				
				default:
					$this->loadData();
					break;
			}
		}
		
	}
	public function deleteRow($row) {
		$record = new Record();
		$record->delete($row);
		$rows = $record->findAll();
		$this->populate($rows);
	}
	public function sort($field, $type) {
		$record = new Record();
		$record->sort($field, $type);
		$rows = $record->findAll();
		$this->populate($rows);
	}
	public function search($value, $column) {
		$arr = array($column .' like '. '"%'.$value.'%"');
		$record = new Record();
		$rows = $record->findAll($arr);
		$this->populate($rows);
	}
	public function loadData(){
		$page = $_POST['page'];
		$records = new Record($page);
		$rows = $records->findAll();
		$this->populate($rows);
	}
	private function populate(array $rows) {
		$str = "";
		$response = array();
		foreach($rows as $row) {
			$companies = str_replace('::', ',', $row['company']);
			$emails = str_replace('::', "<br />", $row['email']);
			$str .= sprintf('<tr>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td><a data-href="%s" href="javascript:void(0);" class="delete">Del</a></td>
				</tr>', $row['firstName'], $row['lastName']
				, $emails, $row['phone'], $companies, $row['id']);
		}
		$response['data'] = $str;
		$response['num_rows'] = count($rows);
		echo json_encode($response);
	}
}

$call = new AjaxCall();
$call->redirect();