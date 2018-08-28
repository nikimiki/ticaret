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
    <link rel="stylesheet" type="text/css" href="css/muayene.css">
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
            $id = $_GET['muayeneView'];
            $muayeneSQL = $pdo->query("SELECT * FROM muayene WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
            $muayeneRow = $muayeneSQL;
            ?>
            <div class="MuayeneMainHeader">
                <p>MUAYENE TALEBİ - <?php echo $muayeneRow['ad_soyad']; ?><a href="muayene.php"><i class="fa fa-reply"></i></a></p>
            </div>
            <div class="MuayeneMainCenter2">
                <div class="MuayeneMainCenter-Line2">
                    <p>Ad - Soyad</p><p><?php echo $muayeneRow['ad_soyad']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>E-Mail</p><p><?php echo $muayeneRow['email']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>Konu</p><p><?php echo $muayeneRow['konu']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>Telefon</p><p><?php echo $muayeneRow['tel']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>Mesaj</p><p><?php echo $muayeneRow['mesaj']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>IP Adresi</p><p><?php echo $muayeneRow['ip']; ?></p>
                </div>
                <div class="MuayeneMainCenter-Line2">
                    <p>Gönderilme Tarihi</p><p><?php echo $muayeneRow['muayene_date']; ?></p>
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