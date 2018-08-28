<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/PictureChange.php');

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
    <link rel="stylesheet" type="text/css" href="css/user.css">
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
                <?php
                $id = $_GET['userView'];
                $userSQL = $pdo->query("SELECT * FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
                $userView = $userSQL;
                ?>
                <div class="UserMainHeader">
                    <p>PROFİL RESMİ - <?php echo strtoupper($userView['user_name']); ?><a href="main.php"><i class="fa fa-reply"></i></a></p>
                </div>
                <div class="UserMainCenter2">

                    <?php
                        if(!isset($_POST['pictureDegistir'])) {
                            echo '
                                <div class="UserProfilPicture">';
                                    if($userView['picture'] == '') { echo '<img src="images/logo-picture.jpg" alt="'.$userView['ad'].' - Profil Resmi"/>'; }
                                    else { echo '<img src="pic/'.$userView['picture'].'" alt="'.$userView['ad'].' - Profil Resmi"/>'; }
                            echo '
                                </div>
                                <form action="#" method="post" enctype="multipart/form-data">
                                <div class="UserMainCenter-Line2">
                                    <p>Profil Resim</p><p><input type="file" name="picture"/></p>
                                </div>

                                <div class="UserMainCenter-Line2">
                                    <button class="NewButton" name="pictureDegistir"><i class="fa fa-key"></i>RESİM DEĞİŞTİR</button>
                                </div>
                                </form>
                            ';
                        } else { ProfilPictureChange($pdo); }
                    ?>

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