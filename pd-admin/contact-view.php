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
    <link rel="stylesheet" type="text/css" href="css/contact.css">
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
            $id = $_GET['contactView'];
            $contactSQL = $pdo->query("SELECT
                contact.id, contact.phone, contact.phone2, contact.phone3, contact.fax, contact.fax2, contact.fax3,
                contact.email, contact.email2, contact.email3, contact.adres, contact.adres2, contact.adres3,
                contact.contact_user, contact.contact_date, users.id, users.user_name
                FROM contact
                INNER JOIN users ON users.id = contact.contact_user
                WHERE contact.id = '$id'")->fetch(PDO::FETCH_ASSOC);
            $contactRow = $contactSQL;
            ?>
            <div class="ContactMainHeader">
                <p>İLETİŞİM <a href="contacts.php"><i class="fa fa-reply"></i></a></p>
            </div>
            <div class="ContactMainCenter2">
                <div class="ContactMainCenter-Line2">
                    <p>Telefon</p><p><?php echo $contactRow['phone']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Telefon 2</p><p><?php echo $contactRow['phone2']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Telefon 3</p><p><?php echo $contactRow['phone3']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Fax</p><p><?php echo $contactRow['fax']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Fax 2</p><p><?php echo $contactRow['fax2']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Fax 3</p><p><?php echo $contactRow['fax3']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>E-Mail</p><p><?php echo $contactRow['email']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>E-Mail 2</p><p><?php echo $contactRow['email2']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>E-Mail 3</p><p><?php echo $contactRow['email3']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Adres</p><p><?php echo $contactRow['adres']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Adres 2</p><p><?php echo $contactRow['adres2']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Adres 3</p><p><?php echo $contactRow['adres3']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Sayfa Ekleme</p><p><?php echo $contactRow['user_name']; ?></p>
                </div>
                <div class="ContactMainCenter-Line2">
                    <p>Ekleme Tarihi</p><p><?php echo $contactRow['contact_date']; ?></p>
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