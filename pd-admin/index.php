<?php
    include_once('includes/connect.php');
    include('includes/login/login.php');

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
        if(isset($_POST['loginSystem'])) {
            if(empty($_POST['user_name']) && empty($_POST['pass'])) {
                echo '<div class="FormArea2"><p><i class="fa fa-exclamation-circle"></i>Kullanıcı Adı ve Şifre boş bırakılamaz !</p></div>';
                header('Refresh:2; url=index.php');
            } else { loginSite($pdo); }
        } else {
            echo '
            <form action="" method="post">
                    <div class="FormArea">
                        <div class="FormIcon"><i class="fa fa-user"></i></div>
                        <input type="text" name="user_name" placeholder="Kullanıcı Adı" class="FormText" />
                    </div>
                    <div class="FormArea">
                        <div class="FormIcon"><i class="fa fa-unlock-alt"></i></div>
                        <input type="password" name="pass" placeholder="Şifre" class="FormText" />
                    </div>
                    <div class="FormAlt">
                        <p><input name="beni_hatirla" value="1" type="checkbox" /> Beni Hatırla</p>
                        <a href="password-reset.php"><p><i class="fa fa-shield"></i>Şifremi Unuttum</p></a>
                    </div>
                    <div class="FormAlt2">
                        <button name="loginSystem" class="LoginButton"><i class="fa fa-power-off"></i></button>
                    </div>
                </form>
            ';
        }
        ?>

</div>

</body>
</html>
<?php ob_end_flush(); ?>