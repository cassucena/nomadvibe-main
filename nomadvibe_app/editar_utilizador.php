<?php include ("includes/header.php");?>

<?php

	if (isset($_SESSION["ID"]))
	{

		$identificacao = $_SESSION["ID"];

		if(isset($identificacao))
		{
			include ("includes/conn2bd.php");


			$query = "SELECT * FROM UTILIZADORES WHERE UTILIZADORES.ID = '$identificacao';";
			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) 
			{
				while($row = mysqli_fetch_assoc($result))
				{

					$nome 			= decrypt(test_input($row["NOME"]), $key);
					$morada 		= decrypt(test_input($row["MORADA"]), $key);
					$codigo_postal 	= decrypt(test_input($row["CODIGO_POSTAL"]), $key);
					$localidade 	= decrypt(test_input($row["LOCALIDADE"]), $key);
					$nif 			= decrypt(test_input($row["NIF"]), $key);
					$telefone 		= decrypt(test_input($row["TELEFONE"]), $key);
					$aniversario 	= decrypt(test_input($row["ANIVERSARIO"]), $key);
					
					?>

					<br /><br /><br /><br /><br /><br /><br /><br />
						<form action="editar_utilizador_BackEnd.php" method="POST">
							<table>
								<tr>
									<td align="right">
										<label>Nome: </label>
									</td>
									<td>
										<input type="text" size="30" name="nome" required pattern="\S(.*\S)?" maxlength="255" value="<?php echo $nome; ?>" required>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label>Morada: </label>
									</td>
									<td>
										<input type="text" size="30" name="morada" required pattern="\S(.*\S)?" maxlength="255" value="<?php echo $morada; ?>" required>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label>Codigo postal: </label>
									</td>
									<td>
										<input type="text" size="10" name="Codigo_postal" required pattern="([0-9]{4}[-]{1}[0-9]{3})" maxlength="8" value="<?php echo $codigo_postal; ?>" required>&nbsp
										<input type="text" size="13" name="localidade" required pattern="\S(.*\S)?" value="<?php echo $localidade; ?>" required>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label>Nif: </label>
									</td>
									<td>
										<input type="text" size="30" name="nif" required pattern="[0-9]{9}" maxlength="9" value="<?php echo $nif; ?>" required>
									</td>
								</tr>
								<tr>
									<td align="right">
										<label>Telefone: </label>
									</td>
									<td>
										<input type="tel" size="30" name="telefone" required pattern="[2]{1}[0-9]{8}" maxlength="9" value="<?php echo $telefone; ?>" required>
									</td>
								</tr>
								<tr>
									<td>
										<label>Data-nascimento: </label>
									</td>
									<td>
										<input size="30" name="aniversario" class="textbox-n" type="DATE" value="<?php echo $aniversario; ?>">
									</td>
								</tr>
								<tr>
									<td></td>
									<td align="right">
										<input type="submit" value="Gravar">&nbsp
										<input type="reset" value="Cancelar">
									</td>
								</tr>

							</table>
						</form>

					<?php

				}

			}
			else
			{
				echo "registo não encontrado";
				header("refresh:5;url=dashboard.php");
			}
	
		}
		else
		{

			echo "ID DE registo não encontrado";
			header("refresh:5;url=dashboard.php");

		}
	
	}
	else
	{
		header( 'Location: login.php' );
	}
								
?>

<?php include ("includes/footer.php");?>