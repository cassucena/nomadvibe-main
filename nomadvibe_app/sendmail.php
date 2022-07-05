<?php include ("includes/header.php");?>

<?php

    $subject        = decrypt (test_input($_SESSION['subject']), $key);
    $mailto         = decrypt (test_input($_SESSION['utilizador']), $key); 
    $messagebody    = decrypt (test_input($_SESSION['messagebody']), $key);

    include('includes/PHPMailer.php');
    include('includes/SMTP.php');
    include('includes/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer();
    $mail -> isSMTP();
    $mail -> Host = "smtp.sapo.pt";
    $mail -> SMTPAuth = "true";
    $mail -> SMTPSecure = "tls";
    $mail -> Port = "587";
    $mail -> Username = "testep@sapo.pt";
    $mail -> Password = "Raventek999666999";
    $mail ->Subject = $subject;
    $mail -> setFrom("testep@sapo.pt");
    //$mail -> addAttachment('files/xpto.docx');
    $mail -> isHTML("true");
    $mail -> Body = $messagebody;
    $mail -> addAddress($mailto);

    if($mail -> send())
    {
        echo "<p>Check your inbox</p>";
        header( "refresh:3;url = index.php" );
    }
    else
    {
        Echo "<p>Unable to send Email</p>";
        header( "refresh:3;url = index.php" );
    }
    
    $mail -> smtpClose();

    $mailto = $messagebody = $subject = "";
?>

<?php include ("includes/footer.php");?>