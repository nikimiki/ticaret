<!doctype html>
<html lang="tr">
<head>
    <title><?=$data['title']?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo BASE_ROOT; ?>">
    <link rel="stylesheet" href="<?php echo BASE_ROOT; ?>public/css/site.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="<?php echo BASE_ROOT; ?>public/js/mobilMenu.js"></script>
</head>
<body>
<?php include_once MOBILE_MENU; ?>
<header>
    <div id="headerTop">
        <div id="topBox">
            <img src="<?php echo BASE_ROOT; ?>public/img/email.png" alt="Email Icon"> <p>info@mustafaozerulukan.com</p>
            <img src="<?php echo BASE_ROOT; ?>public/img/phone.png" alt="Phone Icon"> <p>+90 535 816 30 09</p>
            <div id="topRight">
                <div class="social"><img src="<?php echo BASE_ROOT; ?>public/img/facebook.png" alt="Facebook Icon"></div>
                <div class="social"><img src="<?php echo BASE_ROOT; ?>public/img/twitter.png" alt="Twitter Icon"></div>
                <div class="social"><img src="<?php echo BASE_ROOT; ?>public/img/instagram.png" alt="Instagram Icon"></div>
                <div class="social"><img src="<?php echo BASE_ROOT; ?>public/img/google.png" alt="Google Icon"></div>

                <a href="?lang=TR" class="lang">TR</a>
                <a href="?lang=EN" class="lang">EN</a>
                <a href="?lang=RU" class="lang">RU</a>
            </div>
        </div>
    </div>
    <div id="headerBottom">
        <div id="Logo"><img src="<?php echo BASE_ROOT; ?>public/img/logo.png" alt="Logo"></div>
        <div id="headerMenu">
            <?php include_once TOP_MENU; ?>
        </div>
        <img src="<?php echo BASE_ROOT; ?>public/img/btn-mbl-menu.png" class="mblMenu-icon" alt="Menu Icon">

    </div>
</header>