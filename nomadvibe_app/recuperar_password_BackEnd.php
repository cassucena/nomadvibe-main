<?php include ("includes/header.php");?>

<?php

	if (isset($_SESSION["utilizador"]))
    {

		$value = decrypt (test_input($_SESSION["utilizador"]), $key);
	    $_SESSION["utilizador"] = "";

	    include ("includes/conn2bd.php");

		$query = "SELECT CONTAS.ID, CONTAS.UTILIZADOR, CONTAS.ACTIVO FROM CONTAS WHERE UTILIZADOR = '$value';";
		$login = mysqli_query($conn, $query);

		if (mysqli_num_rows($login) > 0)
		{
		
			while($row = mysqli_fetch_assoc($login))
			{

				if(isset($row["UTILIZADOR"]))
				{

					if ($row["UTILIZADOR"] == $value) 
					{

						if($row["ACTIVO"] == 0)
						{

							$row["ACTIVO"] = $row["UTILIZADOR"] = $row["ID"] = "";
							echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
							echo "<p>Conta desabilitada, por favor entre em contacto com o helpdesk <a href=\"login.php\">Retornar.</a></p>";
		
						}
						else
						{
							$result 		= "";
							$valcode 		= generateRandomString($length = 128);
							$subject 		= "Reset de password para a conta de " . $row["UTILIZADOR"];
                            $messagebody 	= "Para efectuar o reset da sua password clique no <a href=\"http://localhost/nova_pass.php?autcode=$valcode \">link</a>
											<br />
											Este link sera valido por 5 minutos";
											
							$id		= $row["ID"];
							$row["ID"] 	= "";
							date_default_timezone_set('europe/lisbon');
							$date = date("Y-m-d H:i:s");
							$query 			= "INSERT INTO GUIDS(GUIDS.GUID, GUIDS.DATA, GUIDS.ACTIVO, GUIDS.CONTA) VALUES('$valcode', '$date', 1, '$id');";
							$id = $valcode = $date = "";

							$result = mysqli_query($conn, $query);
					
							if(isset($result))
							{
								
								$_SESSION['subject'] 		= encrypt($subject, $key);
								$_SESSION['utilizador']		= encrypt($row["UTILIZADOR"], $key); 
								$_SESSION['messagebody'] 	= encrypt($messagebody, $key);

								$row["ACTIVO"] = $row["UTILIZADOR"] = $messagebody = $subject = "";
								header( 'Location: sendmail.php' );
								die(mysqli_connect_error());

							}
							else
							{

								$row["ACTIVO"] = $row["UTILIZADOR"] = $row["ID"] = $messagebody = $subject = $valcode = $id = "";
								header( 'Location: login.php' );
								die(mysqli_connect_error());
								
							}
					
							mysqli_close($conn);
		
						}
					}
					else 
					{
                        
						echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
						echo "<p>Utilizador não valido tente <a href=\"login.php\">novamente</a></p>";

					}
				}
				else
				{
                    
					echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
					echo "<p>Utilizador não valido tente <a href=\"login.php\">novamente</a></p>";

				}
						
			}

		}
		else
		{

			echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
			echo "<p>Utilizador não valido tente <a href=\"login.php\">novamente</a></p>";

		}
    }
    else
    {

		$_SESSION["username"] = "";
        header( 'Location: login.php' );

    }
	
?>

<?php include ("includes/footer.php");?>