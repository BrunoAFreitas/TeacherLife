<?php
include_once("ChamaQuest.class.php");
include_once("crud.php");

class GeraProvaTurma
{

	private $quest;
	private $crud;
	private $turma;
	private $arrayaluno;

	public function __construct( $turma )
	{
		$this -> quest = new ChamaQuest();
		$this -> crud  = new Crud();
		$this -> turma = $turma;
	}

	public function gerarProvas()
	{

		$this->crud->setTable($this->turma);
		$this->crud->setFields('*');
		$query = $this->crud->select();
		
		while($aluno = mysql_fetch_array($query)){			
			 
			 $this->quest->geraProva($aluno['tur_aluno']);
			 $this->arrayaluno[$aluno['tur_aluno']] = $this->quest->getGabarito();
			 
		}
		
		$this->quest->fexarPdf();
	}
}

$a = new GeraProvaTurma('tuma1a');
$a -> gerarProvas();
?>