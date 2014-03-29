<?php

interface CrudInterface{
	
	public function setTable($tabelas);
	//public function getTable();
	
	public function setFields($tabelas);
	//public function getFields();
	
	public function setDados($dados);
	//public function getDados();
	
	public function setCondicao($condicao);
	//public function getCondicao();
	
	public function insert();
	public function delete();
	public function update();
}

?>