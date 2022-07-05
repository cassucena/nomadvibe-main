<?php

	session_start();

	
	if(empty($_SESSION['PERFIL']))
	{	

		$perfil = 3;
		
	}
	else
	{

		if($_SESSION['ACTIVO'] == 1)
		{

			$perfil = $_SESSION['PERFIL'];

		}
		else
		{		

			$perfil = 3;

		}

	}

?>