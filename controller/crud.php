<?php

// incluindo a pagina de conexao
include_once ("conexao.php");
include_once ("../interface/crud.interface.php");

class Crud implements CrudInterface{
	
	private $sql, $table, $fields, $dados, $status, $id, $valueId, $condicao;
	public $conexao; 
	
	public function __construct(){
		$this -> conexao = new Conexao();
	}
	
	//envia o nome da tabela a ser usada no class
	public function setTable($t) {
		$this -> table = $t;
	}

	//envia os campos a ser usado na class
	public function setFields($f) {
		$this -> fields = $f;
	}

	//os dados ou valores a ser usado na class
	public function setDados($d) {
		$this -> dados = $d;
	}
	
	// passando o valor da condicao
	public function setCondicao($condicao) {
		$this -> condicao = $condicao;
	}

	//envia o campo de pesquisa normalmente o codigo
	public function setId($id) {
		$this -> id = $id;
	}

	//envia os dados a ser pesquisados ou cadastrados
	public function setValueId($valueId) {
		$this -> valueId = $valueId;
	}
	
	//mostra a mensagem na tela
	public function getStatus() {
		return $this -> status;
	}
	
	//metodo que inseri no banco de dados
	public function insert() {
		$this -> sql = "INSERT INTO " . $this->table . " ( " . $this->fields . " ) VALUES ( " . $this->dados . ") ";
		if ($this -> conexao -> exeSQL($this -> sql)) {
			$this -> status = "Cadastrado deu certo";
		}
	}

	//metodo para deletar valores no banco de dados
	public function delete() {
		$this -> sql = "DELETE FROM " . $this->table . " WHERE " . $this->id . " = '" . $this->valueId . "'";
		if ($this -> conexao -> exeSQL($this -> sql)) {
			$this -> status = "Delete deu certo";
		}
	}

	//metodo para atualizar os valores do banco de dados
	public function update() {
		$this -> sql = "UPDATE " . $this->table . "SET" . $this->fields . "WHERE" . $this->id . " = '" . $this->valueId . "' ";
		if ($this -> conexao -> exeSQL($this -> sql)) {
			$this -> status = "Atualizar deu certo";
		}
	}
	
	public function select() {
		$this -> sql = "SELECT " . $this->fields . " FROM " . $this->table;
		if($this-> condicao != null){
			$this -> sql .= " WHERE " . $this->condicao;
		}
		if($this -> qr = $this -> conexao -> exeSQL($this -> sql)) {
			return $this -> qr;	
		}
	}
	
	//metodo que busca a quantidade de valores em um campo no banco de dados
	public function getTotalData() {
		$this -> sql = "SELECT " . $this->id . " FROM " . $this->table . " ORDER BY " . $this->id;
		$this -> qr = $this -> conexao -> exeSQL($this -> sql);
		return $this -> conexao -> countData($this -> qr);
	}
}
?>