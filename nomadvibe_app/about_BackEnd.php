<?php include ("includes/header.php");?>

<?php

    $Nome = $Email = $Telefone = $Assunto = "";

    if(isset($_SESSION['Nome']) && isset($_SESSION['Email']) && isset($_SESSION['Telefone']) && isset($_SESSION['Assunto']))
    {
        date_default_timezone_set('europe/lisbon');
        $date = date("Y-m-d H:i:s");

        $_SESSION['utilizador'] = encrypt( test_input("testep@sapo.pt"), $key);
        $Nome			        = test_input($_SESSION['Nome']);        $_SESSION['Nome']       = "";
        $Email			        = test_input($_SESSION['Email']);       $_SESSION['Email']      = "";
        $Telefone 	            = test_input($_SESSION['Telefone']);    $_SESSION['Telefone']   = "";
        $Assunto 	            = test_input($_SESSION['Assunto']);     $_SESSION['Assunto']    = "";
    
        $subject 	            = 'Sugestao do utilizador' . $Nome;
        $messagebody 	        = "Data: $date  <br />
                                    Nome: $Nome  <br />
                                    email: $Email  <br />
                                    Telefone: $Telefone  <br />
                                    Assunto: $Assunto";
        ;
        
        $Nome = $Email = $Telefone = $Assunto = $date = "";

        $_SESSION['utilizador']     = encrypt('testep@sapo.pt', $key);
        $_SESSION['subject']        = encrypt($subject, $key);
        $_SESSION['messagebody']    = encrypt($messagebody, $key);
        header( 'Location: sendmail.php' );

    }

?>

<?php include ("includes/footer.php");?>