<?php include ("includes/header.php");?>

<?php

	$_SESSION["nome"] 					= 
	$_SESSION["morada"] 				= 
	$_SESSION["Codigo_postal"] 			= 
	$_SESSION["localidade"] 			= 
	$_SESSION["nif"] 					= 
	$_SESSION["telefone"] 				= 
	$_SESSION["aniversario"] 			= 
	$_SESSION["utilizador"] 			= 
	$_SESSION["password"]		 		= 
	$messagem = 						"";
 
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{

		$valida_idade = "";
		$valida_idade = $_POST["aniversario"];
		$valida_ano = substr($valida_idade, 0, -6);
		$valida_mes = substr($valida_idade, -6);
		$idade_legal = 18;
		$data = date('Y-m-d');

		if(isset($valida_ano) && isset($valida_mes)) 
		{
			
			$valida_ano += $idade_legal;
			$valida_idade = $valida_ano . $valida_mes;

			if($valida_idade > $data)
			{
				$mensagem = "<p>Tem de ter mais de 18 anos para usar o nosso serviço.</p>";
				echo $mensagem;
			}
			else
			{
				$_SESSION["nome"] 				= encrypt (test_input($_POST["nome"]), 				$key);
				$_SESSION["morada"] 			= encrypt (test_input($_POST["morada"]), 			$key);
				$_SESSION["Codigo_postal"] 		= encrypt (test_input($_POST["Codigo_postal"]), 	$key);
				$_SESSION["localidade"] 		= encrypt (test_input($_POST["localidade"]), 		$key);
				$_SESSION["nif"] 				= encrypt (test_input($_POST["nif"]), 				$key);
				$_SESSION["telefone"] 			= encrypt (test_input($_POST["telefone"]), 			$key);
				$_SESSION["aniversario"] 		= encrypt (test_input($_POST["aniversario"]), 		$key);
				$_SESSION["utilizador"] 		= encrypt (test_input($_POST["utilizador"]), 		$key);
				$_SESSION["password"] 			= password_hash($_POST["password"], PASSWORD_DEFAULT);
								
				$_POST["nome"] 					=
				$_POST["morada"] 				=
				$_POST["Codigo_postal"] 		=
				$_POST["localidade"] 			=
				$_POST["nif"] 					=
				$_POST["telefone"] 				=
				$_POST["aniversario"] 			=
				$_POST["utilizador"] 			=
				$_POST["password"] 				=
				$_POST["confirmapassword"] 		= "";

				header( 'Location: novo_utilizador_BackEnd.php' );

			}

		}

	}
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

	<div class="divcenter">

		<br /><br /><br />
        
		<div>	

            <input type="text" size="30" name="nome" required pattern="\S(.*\S)?" placeholder="Nome" maxlength="255" required>

        </div><br />
        
		<div>	

            <input type="text" size="30" name="morada" required pattern="\S(.*\S)?" placeholder="Morada" maxlength="255" required>

        </div><br />
        
		<div>	

            <input type="text" size="12" name="Codigo_postal" required pattern="([0-9]{4}[-]{1}[0-9]{3})" placeholder="Codigo-postal" maxlength="8" required>&nbsp
            <input type="text" size="12" name="localidade" required pattern="\S(.*\S)?" placeholder="Localidade" required>

        </div><br />
        
		<div>	

            <input type="text" size="30" name="nif" required pattern="((PT)?([1-2|5-9])[0-9]{8})" placeholder="Nif"  maxlength="9" required>

        </div><br />
        
		<div>	

            <input type="tel" size="30" name="telefone" required pattern="[2|9]{1,2}[0-9]{8}" maxlength="9" placeholder="Telefone" required>

        </div><br />
        
		<div>	

			<input placeholder="Data de nascimento" id="idd" size="30" name="aniversario" class="textbox-n" type="text" onfocus="(this.type='date')">

        </div><br />
		
		<div>	

			<input type="email" size="30" name="utilizador" required pattern="\S(.*\S)?" maxlength="255" required="yes" placeholder="Utilizador">

		</div><br />		
		
		<div>

			<input type="password" name="password" id="pwd" size="30" maxlength="255" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required>

		</div><br />
        
		<div>

            <input type="password" size="30" name="confirmapassword" id="cpwd" maxlength="255" required pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Confirm password" required>

        </div><br />
	    
		<div>

			&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		    <input type="submit" value="Gravar">&nbsp &nbsp
			<input type="reset" value="Cancelar">

	    </div><br />
		
	</div>

</form>

<script>
  	var password 				= document.getElementById("pwd");
  	var confirmapassword 		= document.getElementById("cpwd");
	var confirmaidade 			= document.getElementById("idd");
 
	function validatePassword()
	{

		if(password.value != confirmapassword.value) 
		{

			confirmapassword.setCustomValidity("Passwords Don't Match");

	  	} 
		else 
		{

			confirmapassword.setCustomValidity('');

	  	}

	}
 
	password.onchange 			= validatePassword;
	confirmapassword.onkeyup 	= validatePassword;

	function isOver18() 
	{
		if((confirmaidade.getFullYear() - 18) < 18)
		{
			confirmaidade.setCustomValidity("Tem de ter mais de 18 anos para usar o nosso serviço");
		}
		else 
		{

			confirmaidade.setCustomValidity('');

	  	}
  		// const date18YrsAgo = new Date();
  		// date18YrsAgo.setFullYear(date18YrsAgo.getFullYear() - 18);
  		// return confirmaidade <= date18YrsAgo;
	}

 </script>



<?php include ("includes/footer.php");?>