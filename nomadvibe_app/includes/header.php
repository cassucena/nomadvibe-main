<?php 

	$message = "";

	include ("includes/test_input.php"); 
	include ("includes/krypto.php");
	include	("includes/checklogin.php"); 
	include ("includes/entity.php");
	include ("includes/chargen.php");

?>

<!DOCTYPE html>
<html lang="pt">

<head>

	<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

	<link rel="stylesheet" href="fontawesome/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
	<link href="css/magnific-popup.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <title><?php echo $brand;?></title>

</head>

<body>

	<?php

		$label = "";
			
		if($perfil == 1)
		{

			$label = "Admin";

		}
		elseif($perfil == 2)
		{

			$label = "User";

		}
		else
		{

			$label = "";

		}

	?>

	<div class="container">
		
		<div class="_logo">

			<a href="index.php" TARGET="_self" class="_menu_btn">

				<img src="/img/nomad_logo.png" alt="nomadVibe logo">
				
			</a>

		</div>
		<div class="_menu">
			
			<p>

				<?php

					if ($perfil == 1)
					{

						include("includes/horizontal_menu_admin.php");

					}
					else if ($perfil == 2)
					{

						include("includes/horizontal_menu_user.php");

					}
					else
					{

						include("includes/horizontal_menu.php");

					}

				?>

			</p>

		</div>
		<div class="_main">

			<?php echo $message;?>