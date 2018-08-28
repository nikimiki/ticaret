<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/view/SearchingMainView.php');

    session_start();
    ob_start();

    if(!$_SESSION['officer']) { header('Location: index.php'); }
    $officer = $_SESSION['officer'];
    $officerID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Administration Panel | Poema Design Creative Agency</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/searcing.css">
    <link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/menu-collapsed.js"></script>
</head>
<body>

    <div id="TotalTab">
        <header>
            <div class="HeaderLeft"></div>
            <div class="HeaderRight">
                <?php SearchPart(); ?>
                <?php HeaderOptions($pdo); ?>
            </div>
        </header>
        <section>
            <div class="SectionLeft">
                <?php PartLeft(); ?>
            </div>
            <div class="SectionConText">

                <div class="SearchingMainCenter">
                    <div class="SearchingArama">
                        <form action="searching-full.php" method="post">
                            <input type="text" name="arama" placeholder="Aramak istediğiniz kelimeyi yazınız..."/>
                            <input type="radio" name="arama_secenek" value="1" checked="checked"/>&nbsp; Yazı'da &nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="2"/>&nbsp; Sayfa'da &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="3"/>&nbsp; Alt Sayfa'da &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="4"/>&nbsp; Kategori'de &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="5"/>&nbsp; Alt Kategori'de &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="6"/>&nbsp; Duyuru'da &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="arama_secenek" value="7"/>&nbsp; Yorum'da &nbsp;&nbsp;&nbsp;&nbsp;
                            <button name="aramaYap"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="SectionRight">
                <?php PartRight($pdo); ?>
            </div>
        </section>
    </div>

</body>
</html>
<?php ob_end_flush(); ?>