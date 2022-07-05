<?php include ("includes/header.php");?>

<?php 

    if(!isset($_SESSION["ID"]))
    {
        header( 'Location: login.php' );
    }

?>

<iframe width="100%" height="100%" name="_main" src="./mapa.html" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


<?php include ("includes/footer.php");?>