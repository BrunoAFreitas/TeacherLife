<?php
include_once('crud.php');
require_once('fpdf/fpdf.php');

/**
 *	Esta classe é responsavel pela criação da prova para  e escrita do PDF,
 *  nela busca-se as questoes e numero de questoes de prova para  1 aluno .
 *  O arquivo para uma turma e gerado em outra cassa mas parte desta como principio.
 * 
 *  @author Bruno Araujo <estalatec@gmail.com>
 *  @package controller  
 */

class ChamaQuest {
	
	private $crud;
	private $linkQr;
	private $imageQr;
	private $gabarito;
	private $pdf;
	private $rand;
	private $query;

	public function __construct(){
		
		$this -> crud = new Crud();
		$this -> pdf  = new FPDF("P","pt","A4");
		$this -> setQuery();
		$this -> setRand();
	}

	public function geraGabTurma($alunoGabarito){
		$this->pdf->AddPage();
		$this->pdf->Ln();
		$this->pdf->SetFont('arial','B',18);
		$this->pdf->Cell(0,5,"Gabarito da turma",0,1,'C');
		$this->pdf->Cell(0,5,"","B",1,'C');

		$espaco = 60;

		foreach ($alunoGabarito as $aluno => $gabarito) {

			$espaco = ($espaco > 600) ? 20 : $espaco;

			$this->setGabarito($gabarito);
			$this->pdf->Ln();
			$this->pdf->SetFont('arial','B',12);
			$this->pdf->Cell(70,50,"Aluno:",0,0,'L');
			$this->pdf->setFont('arial','',12);
			$this->pdf->Cell(70,50,$aluno,0,2,'L');
			$this->pdf->Image($this->getLinkQr(),300,$espaco,100,100,'png');

			$espaco += 90;
		}

	}

	protected function setRand(){
		$this->rand = $this->crud->conexao->countData($this->query);
	}

	protected function setQuery(){
		$this->crud->setTable("questoes");
		$this->crud->setFields("*");
		$this->query = $this -> crud -> select(); 
	}
		
	protected function getLinkQr(){
		$this -> linkQr = 'http://chart.apis.google.com/chart?cht=qr&chl=' . $this -> gabarito . '&chs=150x150';
		return $this -> linkQr;
	}
	
	protected function getImageQr(){
		$this -> imageQr = "<img src=" . $this->getLinkQr() . ">";
		return $this -> imageQr;
	}
	 
	public function setGabarito($gab){
		$this -> gabarito = $gab;
	}
	
	public function getGabarito(){
		return $this -> gabarito; 
	}
	
	public function iniciaPdf(){
		$this->pdf->AddPage();
		$this->pdf->Ln();
		$this->pdf->SetFont('arial','B',18);
		$this->pdf->Cell(0,5,"Prova",0,1,'C');
		$this->pdf->Cell(0,5,"","B",1,'C');
	}
	
	protected function cabecalho($nome){
		$this->pdf->Ln();
		$this->pdf->SetFont('arial','B',12);
		$this->pdf->Cell(70,20,"Aluno:",0,0,'L');
		$this->pdf->setFont('arial','',12);
		$this->pdf->Cell(70,20,$nome,0,1,'L');
		
	}
	protected function escreveQuest($quest){
		$this->pdf->setFont('arial','',12);
		$this->pdf->MultiCell(0,20,$quest,0,'J');
	}
	
	protected function escreveAlternativa($alt,$conteudo){
		$this->pdf->SetFont('arial','B',12);
		$this->pdf->Cell(35,20,"$alt:",0,0,'L');
		$this->pdf->setFont('arial','',12);
		$this->pdf->Cell(70,20,$conteudo,0,1,'L');
	}
	
	public function fexarPdf(){
		$this->pdf->Output("arquivo.pdf","D");
	}

	protected function getRandomNumbers($num, $min, $max, $repeat = false, $sort = false){
	    if ((($max - $min) + 1) >= $num) {
	        $numbers = array();

	        while (count($numbers) < $num) {
	            $number = mt_rand($min, $max);

	            if ($repeat || !in_array($number, $numbers)) {
	                $numbers[] = $number;
	            }
	        }

	        switch ($sort) {
	        case SORT_ASC:
	            sort($numbers);
	            break;
	        case SORT_DESC:
	            rsort($numbers);
	            break;
	        }

	        return $numbers;
	    }

	    return false;
	}


	public function geraProva($nomeAluno){
		
		$gabarito = null;
		$this->iniciaPdf();
		$this -> cabecalho($nomeAluno);
		
		$rand = $this->rand;
		
		foreach ($this->getRandomNumbers($rand, 1, $rand, false, false) as $count) {
			
			$this->crud->setCondicao("quest_num = " . $count);
			$linha_quest = $this ->crud->conexao->listQr($this->crud->select());
			$gab = $linha_quest['gabarito'];			
			$this->escreveQuest( $linha_quest['questao']);
			$this->escreveAlternativa('(a)', $linha_quest['alternativa_1']);
			$this->escreveAlternativa('(b)', $linha_quest['alternativa_2']);
			$this->escreveAlternativa('(c)', $linha_quest['alternativa_3']);
			$this->escreveAlternativa('(d)', $linha_quest['alternativa_4']);
			$this->escreveAlternativa('(e)', $linha_quest['alternativa_5']);
					
			$gabarito .= $gab . '|';
		}

		
		$this -> setGabarito($gabarito);
				

	}
		
}

?>