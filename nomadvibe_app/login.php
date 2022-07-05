<?php include ("includes/header.php");?>

<?php

	$_SESSION["utilizador"] = $_SESSION["password"] = "";
	$utilizador_erro = $password_erro = "";
 
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST["utilizador"])) 
		{
    		$utilizador_erro = "Insira um utilizador valido";
  		} 
        else 
	    {
		    $_SESSION["utilizador"] = encrypt (test_input($_POST["utilizador"]), $key);
		    $_POST["utilizador"] = "";
  	    }

  	    if (empty($_POST["password"])) 
	    {
            $password_erro = "Insira uma password valido";
  	    } 
	    else 
	    {
            $_SESSION["password"] = encrypt (test_input($_POST["password"]), $key);
	        $_POST["password"] = "";
  	    }

	    if (isset($_SESSION["utilizador"]) && isset($_SESSION["password"]))
	    {
		    header( 'Location: login_BackEnd.php' );
	    }
    }
	
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

	<div class="divcenter"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

		<div>	
			
			<input type="email" size="38" name="utilizador" required pattern="\S(.*\S)?" placeholder="Login" required>

		</div><br />
					
		<div>

			<input type="password" size="38" name="password" required pattern="\S(.*\S)?" minlength="8" placeholder="Password" required>	

		</div><br />

	    <div>

			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		    <input type="submit" value="Login">&nbsp &nbsp
			<input type="reset" value="Cancelar">

	    </div><br />

		<div>

			<p>Ainda não tem conta, clique em <a href="novo_utilizador.php">criar</a></p>

		</div>

		<div>

			<p>Esqueceu-se da password, clique em <a href="recuperar_password.php">recuperar</a></p>

		</div>

	</div>

	<div class="divcenter">

		<br /><?php echo $utilizador_erro;?>
		<br /><?php echo $password_erro;?>

	</div>

</form>


<?php include ("includes/footer.php");?>