<?php include ("includes/header.php");?>


<?php


    if (isset($_SESSION["utilizador"]) && isset($_SESSION["password"]))
    {


        $value_1 = decrypt (test_input($_SESSION["utilizador"]), $key);
		$value_2 = decrypt (test_input($_SESSION["password"]), $key);

		$_SESSION["utilizador"] = $_SESSION["password"] = "";

		
		include ("includes/conn2bd.php");


		$query = "SELECT CONTAS.ID, CONTAS.PASSWORD, CONTAS.ACTIVO, CONTAS.PERFIL FROM CONTAS WHERE UTILIZADOR = '$value_1';";
		$login = mysqli_query($conn, $query);
		$value_1 = "";

		if (mysqli_num_rows($login) > 0)
		{
		
			while($row = mysqli_fetch_assoc($login))
			{

				$hash = "";

				if(isset($row["PASSWORD"]))
				{

					$hash = $row["PASSWORD"]; $row["PASSWORD"] = "";

					if (password_verify($value_2, $hash)) 
					{

						$value_2 = "";

						if($row["ACTIVO"] == 0 && $row["PERFIL"] != 3)
						{

							$hash = $row["ACTIVO"] = $row["PERFIL"] = "";
							echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
							echo "<p>Conta desabilitada, por favor entre em contacto com o helpdesk.<a href=\"login.php\">Retornar.</a></p>";
		
						}
						else
						{

							$_SESSION['ACTIVO'] = $row["ACTIVO"]; $_SESSION['PERFIL'] = $row["PERFIL"]; $hash = "";
							$_SESSION["ID"] = test_input($row["ID"]);
							header( 'Location: mapa.php' );
		
						}

					}
					else 
					{

						$value_2 = $hash = "";
						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
						echo "<p>Password invalida tente <a href=\"login.php\">novamente</a></p>";

					}

				}
				else
				{

					$value_2 = "";
					header( 'Location: index.php' );

				}
						
			}

		}
		else
		{

			echo "<p>Utilizador ou password invalidos <a href=\"login.php\">Tente novamente</a></p>";

		}

    }
    else
    {

		$_SESSION["utilizador"] = $_SESSION["password"] = "";
        header( 'Location: login.php' );

    }

	
?>


<?php include ("includes/footer.php");?>