<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');

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
                    <p>PROFİL - <?php echo strtoupper($userView['user_name']); ?><a href="main.php"><i class="fa fa-reply"></i></a></p>
                </div>
                <div class="UserMainCenter2">
                    <div class="UserProfilPicture">
                        <?php
                            if($userView['picture'] == '') { echo '<img src="images/logo-picture.jpg" alt="'.$userView['ad'].' - Profil Resmi"/>'; }
                            else { echo '<img src="pic/'.$userView['picture'].'" alt="'.$userView['ad'].' - Profil Resmi"/>'; }
                        ?>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Kullanıcı Adı</p><p><?php echo $userView['user_name']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>E-Mail</p><p><?php echo $userView['email']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Ad</p><p><?php echo $userView['ad']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Soyad</p><p><?php echo $userView['soyad']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Cinsiyet</p><p>
                            <?php
                            if($userView['cinsiyet'] == 1) { echo 'Bay &nbsp;&nbsp;<i class="fa fa-male" style="color: #314a61;"></i>'; }
                            elseif($userView['cinsiyet'] == 2) { echo 'Bayan &nbsp;&nbsp;<i class="fa fa-female" style="color: #C00;"></i>'; }
                            ?>
                        </p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Doğum Tarihi</p><p><?php echo $userView['dtarih']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Öğrenim Durumu</p><p>
                            <?php
                            if($userView['ogrenim'] == 0) { echo 'Öğrenim Durumu Belli Değil'; }
                            elseif($userView['ogrenim'] == 1) { echo 'İlkokul'; }
                            elseif($userView['ogrenim'] == 2) { echo 'Ortaokul'; }
                            elseif($userView['ogrenim'] == 3) { echo 'Lise'; }
                            elseif($userView['ogrenim'] == 4) { echo 'Lisans'; }
                            elseif($userView['ogrenim'] == 5) { echo 'Lisans Üstü'; }
                            elseif($userView['ogrenim'] == 6) { echo 'Master'; }
                            elseif($userView['ogrenim'] == 7) { echo 'Doktora'; }
                            ?>
                        </p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Kayıt Türü</p><p>
                            <?php
                            if($userView['kayit_tur'] == 1) { echo '<span style="color: #C00;margin-left: 0px;">Yönetici</span>'; }
                            elseif($userView['kayit_tur'] == 2) { echo '<span style="color:#ed6c44;margin-left: 0px;">Moderatör</span>'; }
                            elseif($userView['kayit_tur'] == 3) { echo '<span style="color:#d8c20c;margin-left: 0px;">Yazar</span>'; }
                            elseif($userView['kayit_tur'] == 4) { echo '<span style="margin-left: 0px;">Üye</span>'; }
                            ?>
                        </p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <p>Kayıt Tarihi</p><p><?php echo $userView['user_date']; ?></p>
                    </div>
                    <div class="UserMainCenter-Line2">
                        <a href="user-pass-change.php?userView=<?php echo $userView['id']; ?>"><button class="NewButton"><i class="fa fa-key"></i>ŞİFRE DEĞİŞTİR</button></a>
                        <a href="user-email-change.php?userView=<?php echo $userView['id']; ?>"><button class="NewButton"><i class="fa fa-envelope-o"></i>E-MAİL DEĞİŞTİR</button></a>
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