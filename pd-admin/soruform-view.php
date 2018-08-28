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
    <link rel="stylesheet" type="text/css" href="css/soruformu.css">
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
            $id = $_GET['soruformView'];
            $soruSQL = $pdo->query("SELECT * FROM soruform WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
            $soruRow = $soruSQL;
            ?>
            <div class="SoruFormuMainHeader">
                <p>SORU FORMU - <?php echo $soruRow['ad_soyad']; ?><a href="soruform.php"><i class="fa fa-reply"></i></a></p>
            </div>
            <div class="SoruFormuMainCenter2">
                <div class="SoruFormuMainCenter-Line2">
                    <p>Ad - Soyad</p><p><?php echo $soruRow['ad_soyad']; ?></p>
                </div>
                <div class="SoruFormuMainCenter-Line2">
                    <p>E-Mail</p><p><?php echo $soruRow['email']; ?></p>
                </div>
                <div class="SoruFormuMainCenter-Line2">
                    <p>Konu</p><p><?php echo $soruRow['konu']; ?></p>
                </div>
                <div class="SoruFormuMainCenter-Line2">
                    <p>Mesaj</p><p><?php echo $soruRow['mesaj']; ?></p>
                </div>
                <div class="SoruFormuMainCenter-Line2">
                    <p>IP Adresi</p><p><?php echo $soruRow['ip']; ?></p>
                </div>
                <div class="SoruFormuMainCenter-Line2">
                    <p>Gönderilme Tarihi</p><p><?php echo $soruRow['soru_date']; ?></p>
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