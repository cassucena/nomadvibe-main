<?php include ("includes/header.php");?>

<?php
	
	if (empty($_GET["autcode"]))
	{
		header( 'Location: login.php' );
	}

    $password_erro = $confirmapassword_erro = $autenticacao_erro = $autenticacao = "";

	$autenticacao = test_input($_GET["autcode"]);
	$_GET["autcode"] = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
		
		if (empty($_POST["autenticacao"])) 
	    {

    	    $autenticacao_erro = "Autenticação necessaria";

  	    }

        if (empty($_POST["password"])) 
	    {

    	    $password_erro = "Password necessaria";

  	    }

  	    if (empty($_POST["confirmapassword"])) 
	    {

            $confirmpassword_error = "Password confirmation required";

  	    }

	    if ($_POST["password"] == $_POST["confirmapassword"])
	    {

			$_SESSION["autenticacao"] 		= encrypt(test_input($_POST["autenticacao"]), $key);
			$_SESSION["password"] 			= encrypt(test_input($_POST["password"]), $key);
			$_POST["autenticacao"] = $_POST["password"] = $_POST["confirmapassword"] = "";
		    header( 'Location: nova_pass_BackEnd.php' );

	    }
		else
		{

			$password_error = "Passwords do not match";
			$_POST["password"] = $_POST["autentication"] = $_POST["confirmpassword"] = "";
			header( "refresh:3;url = index.php" );

		}

    }

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">


	<div  class="divcenter"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

        <div>

            <input type="password" size="30" name="password" required pattern="\S(.*\S)?" required="yes" minlength="5" placeholder="New password">	

        </div><br />
        	
		<div>

            <input type="password" size="30" name="confirmapassword" required pattern="\S(.*\S)?" required="yes" minlength="5" placeholder="Confirm password">	

        </div><br />
		
		<div>

			<input type="hidden" size="30" name="autenticacao" value="<?php echo $autenticacao ?>" required="yes" minlength="32">	

		</div><br />
	    	
		<div>

            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <input type="submit" class="button save" value="Save">&nbsp &nbsp<input type="reset" class="button cancel" value="Cancel">

	    </div><br />

	</div>

	<div  class="divcenter"><br />

		<?php 
		
			echo $password_erro;
			echo $confirmapassword_erro;
			echo $autenticacao_erro;
		
		?>

	</div>

</form>

<?php include ("includes/footer.php");?>