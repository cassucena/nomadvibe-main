<?php include ("includes/header.php");?>

	<?php	

		if(empty($_POST))
		{

			header( "refresh:3;url=dashboard.php" );
			die("Invalid id" . mysqli_connect_error());

		}

		$id 			= $_SESSION["ID"];
		$nome			= encrypt(test_input($_POST["nome"]), $key); 				$_POST["nome"] = "";
		$morada			= encrypt(test_input($_POST["morada"]), $key); 				$_POST["morada"] = "";
		$Codigo_postal 	= encrypt(test_input($_POST["Codigo_postal"]), $key); 		$_POST["Codigo_postal"] = "";
		$localidade 	= encrypt(test_input($_POST["localidade"]), $key); 			$_POST["localidade"] = "";
		$nif 			= encrypt(test_input($_POST["nif"]), $key); 				$_POST["nif"] = "";
		$telefone 		= encrypt(test_input($_POST["telefone"]), $key); 			$_POST["telefone"] = "";
		$aniversario 	= encrypt(test_input($_POST["aniversario"]), $key); 		$_POST["aniversario"] = "";

		include ("includes/conn2bd.php");

		$query = "UPDATE UTILIZADORES SET UTILIZADORES.NOME = '$nome', UTILIZADORES.MORADA = '$morada', UTILIZADORES.codigo_postal = '$Codigo_postal', UTILIZADORES.LOCALIDADE = '$localidade', UTILIZADORES.NIF = '$nif',  UTILIZADORES.TELEFONE = '$telefone', UTILIZADORES.aniversario = '$aniversario'  WHERE ID = '$id';";

		$result = mysqli_query($conn, $query); $query = "";

		if($result)
		{

			header( "refresh:3;url=dashboard.php" );
			die("Record successfully modified" . mysqli_connect_error());
			
		}
		else
		{
			header( "refresh:3;url=dashboard.php" );
			die("Unable to change record" . mysqli_connect_error());
		}

		mysqli_close($conn);
	?>

<?php include ("includes/footer.php");?>