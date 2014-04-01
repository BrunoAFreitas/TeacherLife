<?php
include_once('../controller/crud.php');

$questao      = $_POST['questao'];
$alternativa1 = $_POST['alternativa1'];
$alternativa2 = $_POST['alternativa2'];
$alternativa3 = $_POST['alternativa3'];
$alternativa4 = $_POST['alternativa4'];
$alternativa5 = $_POST['alternativa5'];
$gabarito     = $_POST['gabarito'];
$materia      = $_POST['materia'];

$tabela  = "questoes";
$campos  = "questao, alternativa_1, alternativa_2, alternativa_3, alternativa_4, alternativa_5, gabarito, materia";
$valores = "'$questao', '$alternativa1', '$alternativa2', '$alternativa3', '$alternativa4', '$alternativa5', '$gabarito', '$materia'";

$a = new Crud();
$a -> setTable($tabela);
$a -> setFields($campos);
$a -> setDados($valores);
$a -> insert();
?>