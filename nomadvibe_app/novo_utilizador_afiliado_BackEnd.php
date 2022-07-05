<?php include ("includes/header.php");?>

<?php

	$nome 		= 
	$morada 	= 
	$Codigo_postal 	= 
	$localidade 	= 
	$nif 		= 
	$telefone 	= 
	$aniversario 	= 
	$utilizador 	= 
	$password 	= "";

	if (isset($_SESSION["nome"]) 
	&& isset($_SESSION["morada"])
	&& isset($_SESSION["Codigo_postal"])
	&& isset($_SESSION["localidade"])
	&& isset($_SESSION["nif"])
	&& isset($_SESSION["telefone"])
	&& isset($_SESSION["aniversario"])
	&& isset($_SESSION["utilizador"])
	&& isset($_SESSION["password"])
	)
	{
		$nome 					= 	test_input($_SESSION["nome"]);
		$morada 				=	test_input($_SESSION["morada"]);
		$Codigo_postal 				= 	test_input($_SESSION["Codigo_postal"]);
		$localidade 				=	test_input($_SESSION["localidade"]);
		$nif					= 	test_input($_SESSION["nif"]);
		$telefone 				= 	test_input($_SESSION["telefone"]);
		$aniversario 				=	test_input($_SESSION["aniversario"]);
		$utilizador 				=	decrypt (test_input($_SESSION["utilizador"]), $key);
		$palavra_passe 				=	test_input($_SESSION["password"]);

		$_SESSION["nome"] 			=
		$_SESSION["morada"] 			=
		$_SESSION["Codigo_postal"] 		=
		$_SESSION["localidade"] 		=
		$_SESSION["nif"] 			=
		$_SESSION["telefone"] 			=
		$_SESSION["aniversario"] 		=
		$_SESSION["utilizador"] 		=
		$_SESSION["password"] 			= "";

		include ("includes/conn2bd.php");

		$query = "SELECT UTILIZADOR FROM CONTAS WHERE UTILIZADOR = '$utilizador';";
		$result = mysqli_query($conn, $query);
		
		if (mysqli_num_rows($result) == 0) 
		{	
			$valcode 		= generateRandomString($length = 128);
			$mysqli = $conn;
			
			$mysqli ->autocommit(false);
			$mysqli->query("INSERT INTO UTILIZADORES (UTILIZADORES.NOME, UTILIZADORES.MORADA, UTILIZADORES.CODIGO_POSTAL, UTILIZADORES.LOCALIDADE, UTILIZADORES.NIF, UTILIZADORES.TELEFONE, UTILIZADORES.ANIVERSARIO) VALUES ('$nome', '$morada', '$Codigo_postal', '$localidade', '$nif', '$telefone', '$aniversario')");
			$mysqli->query("INSERT INTO CONTAS (CONTAS.UTILIZADOR, CONTAS.PASSWORD, CONTAS.ACTIVO, CONTAS.PERFIL, CONTAS.ID_UTILIZADOR, CONTAS.ROLE, CONTAS.VALIDADE) VALUES('$utilizador', '$palavra_passe', 0, 2, LAST_INSERT_ID(), 1, DATE_ADD(CURDATE(), INTERVAL +12 MONTH))");
			$mysqli->query("INSERT INTO GUIDS(GUIDS.GUID, GUIDS.DATA, GUIDS.ACTIVO, GUIDS.CONTA) VALUES('$valcode', '$date', 1, LAST_INSERT_ID());");
			$mysqli->commit();

			$subject 	= "Activar conta $brand";
			$messagebody 	= "Para activar a sua conta clique no <a href=\"http://localhost/novo_utilizador_activacao.php?autcode=$valcode \">link</a>";

			date_default_timezone_set('europe/lisbon');
			$date = date("Y-m-d H:i:s");
			$valcode = $date = "";

			$result = mysqli_query($conn, $query);
		
			if(isset($result))
			{
					
				$_SESSION['subject'] 		= encrypt($subject, $key);
				$_SESSION['utilizador']		= encrypt($utilizador, $key); 
				$_SESSION['messagebody'] 	= encrypt($messagebody, $key);

				$messagebody = $subject = "";
				header( 'Location: sendmail.php' );
				die(mysqli_connect_error());

			}
			else
			{

				$messagebody = $subject ="";
				die(mysqli_connect_error());
				header( "refresh:3;url=login.php" );
					
			}

					
		} 
		else 
		{
			
			$result = "";	
			echo "Utilizador já existente!...";
			header( "refresh:3;url=login.php" );
	
		}
		
		mysqli_close($conn);

	}
	else
	{
		$_SESSION["nome"] 			=
		$_SESSION["morada"] 			=
		$_SESSION["Codigo_postal"] 		=
		$_SESSION["localidade"] 		=
		$_SESSION["nif"] 			=
		$_SESSION["telefone"] 			=
		$_SESSION["aniversario"] 		=
		$_SESSION["utilizador"] 		=
		$_SESSION["password"] 			= "";

		echo "Registo não efectuado";
		header("refresh:5;url=login.php");
	}
?>

<?php include ("includes/footer.php");?>