<?php include ("includes/header.php");?>

<?php

	if (empty($_GET["autcode"]))
	{
		header( 'Location: login.php' );
	}

    	$autenticacao = "";
	$autenticacao = test_input($_GET["autcode"]);
	$_GET["autcode"] = "";

    if (isset($autenticacao))
    {
		
	    include ("includes/conn2bd.php");


		$query = "SELECT GUIDS.GUID, GUIDS.ACTIVO, GUIDS.CONTA FROM GUIDS WHERE GUID = '$autenticacao';";
		$login = mysqli_query($conn, $query);

		if (mysqli_num_rows($login) > 0)
		{

			while($row = mysqli_fetch_assoc($login))
			{

				if(isset($row["GUID"]))
				{

					if ($autenticacao == $row["GUID"]) 
					{

						if($row["ACTIVO"] == 0)
						{

							$row["GUID"] = $row["ACTIVO"] = $row["CONTA"] = "";
                            				$autenticacao = "";

							echo "<p>Autenticação não valida, por favor tente <a href=\"login.php\">novamente</a></p>";
		
						}
						else
						{

							$conta = $row["CONTA"]; $row["CONTA"] = "";
							$query = "UPDATE GUIDS, CONTAS SET GUIDS.ACTIVO = 0, CONTAS.ACTIVO = 1 WHERE GUIDS.GUID = '$autenticacao' AND CONTAS.ID = '$conta';";
							$result = mysqli_query($conn, $query);

							if(isset($result))
							{

								$row["GUID"] = $row["ACTIVO"] = "";
								$autenticacao = $conta = "";

								header( "refresh:3;url=login.php" );
								die("<p>Conta activada com sucesso</p>" . mysqli_connect_error());

							}
							else
							{

								$row["GUID"] = $row["ACTIVO"] = "";
								$autenticacao = $conta = "";

								header( "refresh:3;url=login.php" );
								die("<p>Activação não efectuada</p>" . mysqli_connect_error());

							}                          
		
						}

					}
					else 
					{

                        			$row["GUID"] = $row["ACTIVO"] = $row["CONTA"] = "";
						$autenticacao = "";
						echo "<p>Activação de conta não concluida tente <a href=\"login.php\">novamente</a></p>";

					}

				}
				else
				{

                    			$row["GUID"] = $row["ACTIVO"] = $row["CONTA"] = "";
					$autenticacao = "";
					header( 'Location: index.php' );

				}
						
			}

		}
		else
		{

            		$row["GUID"] = $row["ACTIVO"] = $row["CONTA"] = "";
            		$value_1 = $value_2 = "";

			echo "<p>Autenticação não valida, tente <a href=\"login.php\">novamente</a></p>";

		}

    }
    else
    {

	$autenticacao = "";
        header( 'Location: login.php' );

    }

	
?>

<?php include ("includes/footer.php");?>