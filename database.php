<?php
class PDOMySQL{
	var $koneksi;

	function __construct(){
		$this->koneksi = new PDO("mysql:host=localhost;dbname=dbsekolah","root","");
	}

	function  Execute($query, $params=[]){
		$stmt = $this->koneksi->prepare($query);
		$stmt->execute($params);
	}

	function GetData($query, $params=[]){
		$stmt = $this->koneksi->prepare($query);
		$stmt->execute($params);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $data;
	}

	function __destruct(){
		$this->koneksi = null;
	}
}

class MySQLDB{
	var $koneksi;

	function __construct(){
		$this->koneksi = new mysqli("localhost","root","","dbsekolah");
	}

	function Execute($query, $params=[]){
		$stmt = $this->koneksi->prepare($query);
		if(count($params)>0){
			$paramStr = str_repeat('s', count($params));
			$stmt->bind_param($paramStr, ...$params);
		}
		$stmt->execute();
		$stmt->close();
	}

	function GetData($query, $params=[]){
		$stmt = $this->koneksi->prepare($query);
		if(count($params)>0){
			$paramStr = str_repeat('s', count($params));
			$stmt->bind_param($paramStr, ...$params);
		}
		$stmt->execute();
		$result = $stmt->get_result();
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$stmt->close();
		return $data;
	}

	function __destruct(){
		$this->koneksi->close();
	}

}

