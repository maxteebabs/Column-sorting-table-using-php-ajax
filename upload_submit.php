<?php
// namespace model;
include('model/Record.php');

class Upload{
	private $valid_ext = array('csv');
	public function read() {
		try{
			$file = $_FILES;
			if(count($file) == 0) {
				throw new Exception('You need to increase the size of your php ini to atleast 500 mb to upload huge file');
			}
			$filename = $file['records']['name'];
			$tmp_name = $file['records']['tmp_name'];
			$ext = end(explode('.', $filename));
			if(!in_array($ext, $this->valid_ext)) {
				throw new Exception('must be a valid .csv file');
			}

			//we have to read the file
			$str = '';
			if(is_uploaded_file($tmp_name)) {
				$csv = fopen($tmp_name, 'r');
				fgetcsv($csv);
				while(($row = fgetcsv($csv)) !== FALSE){
					$record = new Record();
					$record->id = $row[0];
					$record->firstName = $row[1];
					$record->lastName = $row[2];
					$record->email = $row[3];
					$record->phone = $row[4];
					$record->company = $row[5];
					$record->create();
				}
			}
			header('Location: upload.php?success="Success"');

		}catch(Exception $ex) {
			echo $ex->getMessage();exit;
		}
	}
}
$upload = new Upload();
$upload->read();