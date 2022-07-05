<?php include ("includes/header.php");?>

<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $_SESSION["Nome"]       = test_input($_POST["Nome"]);
        $_SESSION["Email"]      = test_input($_POST["Email"]);
        $_SESSION["Telefone"]   = test_input($_POST["Telefone"]);
        $_SESSION["Assunto"]    = test_input($_POST["Assunto"]);
        header( 'Location: about_BackEnd.php' );
    }

?>

<br /><br /><br />

<div class="acerca">

    <div class="acerca_1">

        <h3>Acerca</h3>

        <P>Empresa orientada para o futuro, visa ser um facilitador na vida do turista, entregando um serviço de excelência de “personal Travel Agent”, comprometida com a máxima satisfação de seus clientes.</P>

        <p>Siga-nos nas redes sociais</p>

        <div class="redes_sociais">

            <a href="https://facebook.com"><i class="fab fa-facebook"></i></a>
            <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com"><i class="fab fa-instagram"></i></a>

        </div>

    </div>

    <div class="acerca_2">

        <h3>Solicite um contacto</h3>

        <h4>Explique-nos como o podemos ajudar.</h4>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">

            <div>	

                <input type="text" size="30" name="Nome" required pattern="\S(.*\S)?" placeholder="Nome" maxlength="255" required>

            </div><br />

            <div>	

                <input type="email" size="30" name="Email" required pattern="\S(.*\S)?" maxlength="255" required="yes" placeholder="Email">

            </div><br />

            <div>	

                <input type="tel" size="30" name="Telefone" required pattern="[2|9]{1,2}[0-9]{8}" maxlength="9" placeholder="Telefone de contacto" required>

            </div><br />

            <div>	

                <input type="text" size="30" name="Assunto" cols="1" rows="5" style="width:230px; height:50px;"  required pattern="\S(.*\S)?" placeholder="Submeta a sua questão" maxlength="255" required>

            </div><br />

            <div>

                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                <input type="submit" value="Submeter">&nbsp &nbsp
                <input type="reset" value="Cancelar">

            </div><br />

        </form>
        
    </div>

</div>

<?php include ("includes/footer.php");?>