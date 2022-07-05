<?php include ("includes/header.php");?>

<?php

	$_SESSION["utilizador"] = "";
	$utilizador_erro = "";
 
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (empty($_POST["utilizador"])) 
	    {

    	    $utilizador_erro = "Utilizador é um campo necessario";

  	    } 
        else 
	    {

			$_SESSION["utilizador"] = encrypt (test_input($_POST["utilizador"]), $key);
		    $_POST["utilizador"] = "";

  	    }

	    if (isset($_SESSION["utilizador"]))
	    {

		    header( 'Location: recuperar_password_BackEnd.php' );

	    }
    }

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

	<div  class="divcenter"><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

		<div>	

			<input type="email" size="30" name="utilizador" required pattern="\S(.*\S)?" required="yes" placeholder="Insira o Email a recuperar">
            <input type="submit" value="Recuperar">

		</div><br />

	</div>

	<div  class="divcenter"><br />

		<?php echo $utilizador_erro;?><br />

	</div>

</form>

<?php include ("includes/footer.php");?>