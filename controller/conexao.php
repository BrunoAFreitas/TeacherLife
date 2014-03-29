<?php
include_once("../interface/constantes.bd.php");
class Conexao {

	private $host, $user, $pass, $dba, $conn, $qr, $data,  $totalFildes, $error;

	public function __construct() {
		
		$this -> host = HOST;
		$this -> user = USER;
		$this -> pass = PASS;
		$this -> dba  = DBA;
		self::connect();

	}

	protected function connect() {
		$this -> conn = mysql_connect($this -> host, $this -> user, $this -> pass)or die ("Erro na conexão com : " . $this -> host);
		$this -> dba = mysql_select_db($this -> dba, $this -> conn)or die("Erro na conexão com: " . $this -> dba);

	}

	public function exeSQL($sql) {
		$this -> qr = mysql_query($sql)or die ("Erro SQL: " . $sql);
		return $this -> qr;
	}
	
	public function listQr($qr) {
		$this -> data = mysql_fetch_assoc($qr);
		return $this -> data;
	}

	public function countData($qr) {
		$this -> totalFildes = mysql_num_rows($qr);
		return $this -> totalFildes;
	}

}
?>