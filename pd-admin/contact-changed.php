<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/ContactChange.php');

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
    <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
    <script type="text/javascript" src="js/dilSec.js"></script>
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
            <div class="ContactMainHeader">
                <p><a href="pages.php"><i class="fa fa-reply"></i></a>İLETİŞİM | DEĞİŞTİR</p>
            </div>
            <div class="ContactMainCenter2">
                <?php
                if(!isset($_POST['contactDegistir'])) {
                    $id = $_GET['contactChange'];
                    $contactSQL = $pdo->query("SELECT
                        contact.id, contact.phone, contact.phone2, contact.phone3, contact.fax, contact.fax2, contact.fax3,
                        contact.email, contact.email2, contact.email3, contact.adres, contact.adres2, contact.adres3,
                        contact.contact_user, contact.contact_date, users.id, users.user_name
                        FROM contact
                        INNER JOIN users ON users.id = contact.contact_user
                        WHERE contact.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $contactRow = $contactSQL;
                    echo '
                                <form action="#" method="post">
                                <div class="ContactMainCenter-Line2">
                                    <p>Telefon</p>
                                    <p><input type="text" name="phone" value="'.$contactRow['phone'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Telefon 2</p>
                                    <p><input type="text" name="phone2" value="'.$contactRow['phone2'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Telefon 3</p>
                                    <p><input type="text" name="phone3" value="'.$contactRow['phone3'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Fax</p>
                                    <p><input type="text" name="fax" value="'.$contactRow['fax'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Fax 2</p>
                                    <p><input type="text" name="fax2" value="'.$contactRow['fax2'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Fax 3</p>
                                    <p><input type="text" name="fax3" value="'.$contactRow['fax3'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>E-Mail</p>
                                    <p><input type="text" name="email" value="'.$contactRow['email'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>E-Mail 2</p>
                                    <p><input type="text" name="email2" value="'.$contactRow['email2'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>E-Mail 3</p>
                                    <p><input type="text" name="email3" value="'.$contactRow['email3'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Adres</p>
                                    <p><input type="text" name="adres" value="'.$contactRow['adres'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Adres 2</p>
                                    <p><input type="text" name="adres2" value="'.$contactRow['adres2'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Adres 3</p>
                                    <p><input type="text" name="adres3" value="'.$contactRow['adres3'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                    $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                    echo $oturum['user_name'];
                    echo '
                                <input type="hidden" name="contact_user" value="'.$oturum['id'].'"/></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'.$contactRow['contact_date'].'<input type="hidden" value="'.$id.'" /></p>
                                </div>
                                <div class="ContactMainCenter-Line2">
                                    <button name="contactDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                </div>
                                </form>
                        ';

                } else { contactChange($pdo); }
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