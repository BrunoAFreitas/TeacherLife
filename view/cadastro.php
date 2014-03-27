<html>
	<head>
		<title>Cadastro de Questões</title>
		<link rel="stylesheet" href="estilo.css" />
		
		<script type="text/javascript" src="plugins/jqueryDiretorio.js"></script>
		<script type="text/javascript" src="plugins/jquery_mask1.2.2.js" ></script>

		<script type="text/javascript" src="mets.js" ></script>

	</head>

	<body>
		<form action="../model/cadastrar.php" name = "form" id = "form" method="post">
		<table>
		
			<tr>
			<fieldset>
			<legend> Questão </legend>
				
				 	<input type=text size= '70' maxlength= '100' name="questao"/>
				
			</fieldset>	 	
		    </tr>
		    <tr>
		 	
		 	<fieldset>
		 	<legend>Alternativas</legend>				 	
				 
				<input id = "alternativa1" type="text" name="alternativa1" />
				<input id = "alternativa2" type="text" name="alternativa2" />
				<input id = "alternativa3" type="text" name="alternativa3" />
				<input id = "alternativa4" type="text" name="alternativa4" />
				<input id = "alternativa5" type="text" name="alternativa5" />
				
			</fieldset>
			
			</tr>
			<tr>
				
			<fieldset>
			<legend>Correção</legend>
		
				Gabarito:<input id = "gabarito" type="text" name="gabarito" size="2" />
				Materia :<input id = "materia" type="text"  name="materia"  />
			
			</fieldset>
			</tr>
		
		
		
		</table>
	<input type="submit" value="Enviar" />
	</form>
	</body>

</html>


