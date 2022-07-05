<?php include ("includes/header.php");?>

<?php


    if (isset($_SESSION["autenticacao"]) && isset($_SESSION["password"]))
    {


        $value_1 = decrypt(test_input($_SESSION["autenticacao"]), $key);
        $value_2 = decrypt(test_input($_SESSION["password"]), $key);
		$value_2 = password_hash($value_2, PASSWORD_DEFAULT);
		$_SESSION["autenticacao"] = $_SESSION["password"] = "";

		
	    include ("includes/conn2bd.php");


		$query = "SELECT GUIDS.GUID, CAST(GUIDS.DATA AS DATETIME) AS DATA, GUIDS.ACTIVO, GUIDS.CONTA FROM GUIDS WHERE GUID = '$value_1';";
		$login = mysqli_query($conn, $query);

		if (mysqli_num_rows($login) > 0)
		{

			while($row = mysqli_fetch_assoc($login))
			{

				if(isset($row["GUID"]))
				{

					if ($value_1 == $row["GUID"]) 
					{

						if($row["ACTIVO"] == 0)
						{

							$row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
                            $value_1 = $value_2 = "";

							echo "<p>Codigo de autenticação não valido, por favor tente <a href=\"login.php\">novamente</a></p>";
		
						}
						else
						{

							date_default_timezone_set('europe/lisbon');
						
							$date = date("Y-m-d H:i:s");
							$dbdate = $row["DATA"];
							$dbdateplus5 = date('Y-m-d H:i',strtotime("+5 minutes", strtotime($dbdate)));
                            
                            if($date > $dbdate && $date < $dbdateplus5)
                            {

								$value_3 = $row["CONTA"];
								$query = "UPDATE GUIDS, CONTAS SET GUIDS.ACTIVO = 0, CONTAS.PASSWORD = '$value_2' WHERE GUIDS.GUID = '$value_1' AND CONTAS.ID = '$value_3';";
								$result = mysqli_query($conn, $query);

								if(isset($result))
								{

									$row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
									$value_1 = $value_2 = $value_3 ="";

									header( "refresh:3;url=login.php" );
									die("<p>Registo modificado com sucesso</p>" . mysqli_connect_error());

								}
								else
								{

									$row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
									$value_1 = $value_2 = $value_3 ="";

									header( "refresh:3;url=login.php" );
									die("<p>Alteração não efectuada</p>" . mysqli_connect_error());

								}

                            }
                            else
                            {
								
                                $row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
                                $value_1 = $value_2 = "";

                                echo "<p>Codigo de autenticação expirado, por favor tente <a href=\"login.php\">novamente</a></p>";
                                
                            }                           
		
						}

					}
					else 
					{

                        $row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
						$value_1 = $value_2 = "";

						echo "<p>Account authentication failed, please try <a href=\"login.php\">again</a></p>";

					}

				}
				else
				{

                    $row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
					$value_1 = $value_2 = "";

					header( 'Location: index.php' );

				}
						
			}

		}
		else
		{

            $row["GUID"] = $row["DATA"] = $row["ACTIVO"] = $row["CONTA"] = "";
            $value_1 = $value_2 = "";

			echo "<p>Account authentication failed, please try <a href=\"login.php\">again</a></p>";

		}

    }
    else
    {

		$_SESSION["autentication"] = $_SESSION["password"] = "";

        header( 'Location: login.php' );

    }

	
?>

<?php include ("includes/footer.php");?>