<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
define("MYSQL_HOST","10.0.0.8");
define("MYSQL_DB_NAME","abcertification_blob");
define("MYSQL_DB_MYSQL","mysql");
define("MYSQL_LOGIN","admin#0");
define("MYSQL_PASSWORD",'5Qj$Gj7DZD%Ffn3K');

$options = array(
		'delete_type' => 'POST',
		'db_host' => MYSQL_HOST,
		'db_user' => MYSQL_LOGIN,
		'db_pass' => MYSQL_PASSWORD,
		'db_name' => MYSQL_DB_NAME,
		'db_table' => 'blob_test'
);


error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

	protected function initialize() {
		$this->db = new mysqli(
				$this->options['db_host'],
				$this->options['db_user'],
				$this->options['db_pass'],
				$this->options['db_name']
		);
		parent::initialize();
		$this->db->close();
	}

	protected function handle_form_data($file, $index) {
		@session_start();
		$file->title = @$_REQUEST['title'][$index];
		$file->id_session = session_id();
	}

	protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
	$index = null, $content_range = null) {
		$file = parent::handle_file_upload(
				$uploaded_file, $name, $size, $type, $error, $index, $content_range
		);
		if (empty($file->error)) {
			
			$TabLog = array (
					'sys_timestamp' => date('Y-m-d H:i:s',$_SERVER["REQUEST_TIME"]),
					'sys_ip' => $_SERVER["REMOTE_ADDR"]
			);
				
			$fp = fopen (  $file->uploaded_file, 'r' );
			$adf_fichier = fread ( $fp, $file->size );
			fclose ( $fp );
			$NbCar=session_id();
			$sql = 'INSERT INTO `'.$this->options['db_table']
			.'` (`name`, `size`, `type`, `title`, `id_session`,`fichierblob`,`sys_timestamp`,`sys_ip`)'
					.' VALUES (?, ?, ?, ?, ?, ?,?,?)';
			$query = $this->db->prepare($sql);
			$query->bind_param(
					'sissssss',
					$file->name,
					$file->size,
					$file->type,
					$file->title,
					$file->id_session,
					$adf_fichier,
					$TabLog['sys_timestamp'],
					$TabLog['sys_ip']
					
			);
			$query->execute();
			$file->id = $this->db->insert_id;
		}
		return $file;
	}

	public function delete($print_response = true) {
		$response = parent::delete(false);
		foreach ($response as $name => $deleted) {
			if ($deleted) {
				$sql = 'DELETE FROM `'
						.$this->options['db_table'].'` WHERE `name`=?';
				$query = $this->db->prepare($sql);
				$query->bind_param('s', $name);
				$query->execute();
			}
		}
		return $this->generate_response($response, $print_response);
	}

	

}

$upload_handler = new CustomUploadHandler($options);