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
    <link rel="stylesheet" type="text/css" href="css/analiz.css">
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
            $id = $_GET['analizView'];
            $analizSQL = $pdo->query("SELECT * FROM foto_muayene WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
            $analizRow = $analizSQL;
            ?>
            <div class="AnalizMainHeader">
                <p>FOTOĞRAF ANALİZ - <?php echo $analizRow['ad_soyad']; ?><a href="analiz.php"><i class="fa fa-reply"></i></a></p>
            </div>
            <div class="AnalizMainCenter2">
                <div class="AnalizMainCenter-Line2">
                    <p>Ad - Soyad</p><p><?php echo $analizRow['ad_soyad']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>E-Mail</p><p><?php echo $analizRow['email']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>Konu</p><p><?php echo $analizRow['konu']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>Telefon</p><p><?php echo $analizRow['tel']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>Mesaj</p><p><?php echo $analizRow['mesaj']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>IP Adresi</p><p><?php echo $analizRow['ip']; ?></p>
                </div>
                <div class="AnalizMainCenter-Line2">
                    <p>Gönderilme Tarihi</p><p><?php echo $analizRow['foto_date']; ?></p>
                </div>
                <?php
                    $resimAyir = explode(',', $analizRow['resim']);
                    foreach($resimAyir as $resim) {
                        echo '<img src="pic/hasta_resim/'.trim($resim).'" alt="" style="width:180px;float:left;margin:10px;"/>';
                    }
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