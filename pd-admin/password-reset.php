<?php
    include_once('includes/connect.php');
    include('includes/passReset.php');

    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration Panel | Poema Design Creative Agency</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
    <script type="text/javascript" src="js/date-time.js"></script>
</head>
<body>

<div id="Login">
    <div class="Logo"></div>
    <div class="Saat" id="date_time"></div>
    <script type="text/javascript">window.onload = date_time('date_time');</script>
    <div class="LogoAvatar"></div>

    <?php
        if(!isset($_POST['passDegis'])) {
            echo '
                <form action="" method="post">
                    <div class="FormArea2">
                        <div class="FormIcon"><i class="fa fa-envelope-o"></i></div>
                        <input type="text" name="email" placeholder="E-Mail Adresiniz" class="FormText2" />
                    </div>
                    <button name="passDegis" class="LoginButton2"><i class="fa fa-paper-plane-o"></i></button>
                </form>
            ';
        } else { passReset($pdo); }
    ?>

</div>

</body>
</html>
<?php ob_end_flush(); ?>