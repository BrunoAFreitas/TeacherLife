<?php

include_once("../controller/crud.php");

$aluno = $_POST['aluno'];

$tabela = 'tuma1a';
$campos = 'tur_aluno';

$a = new Crud();
$a -> setTable($tabela);
$a -> setFields($campos);
$a -> setDados("'$aluno'");
$a -> insert();



?>