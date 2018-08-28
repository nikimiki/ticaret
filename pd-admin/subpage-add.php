<?php
    include('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/SubPageAdd.php');

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
        <link rel="stylesheet" type="text/css" href="css/subpage.css">
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
                <div class="SubPageMainHeader">
                    <p><a href="subpages.php"><i class="fa fa-reply"></i></a>ALT SAYFALAR</p>
                </div>
                <div class="SubPageMainCenter2">
                    <?php
                    if (!isset($_POST['subpageGonder'])) {
                        echo '
                            <div id="turkceDil-Tab">TÜRKÇE</div>
                            <div id="englishDil-Tab">ENGLISH</div>
                            <div id="germanDil-Tab">GERMAN</div>
                            <div id="russianDil-Tab">RUSSIAN</div>
                            <div id="bulgarianDil-Tab">BULGARIAN</div>
                            <div id="arabianDil-Tab">ARABIAN</div>
                            <form action="#" method="post">
                            <div id="turkceDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>Eklenecek Yer</p>
                                <p>
                                    <select name="page_id">
                                        <option value="0">Lütfen Sayfa seçiniz</option>';
                        $pageSQL = $pdo->prepare("SELECT id, page_name FROM page");
                        $pageSQL->execute();
                        $pageFetch = $pageSQL->fetchAll();
                        foreach($pageFetch as $pageRow) { echo '<option value="'.$pageRow['id'].'">'.$pageRow['page_name'].'</option>'; }
                        echo '
                                    </select>
                                </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Adı</p>
                                <p><input type="text" name="subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa İçerik</p>
                                <p><textarea name="subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                                $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                                echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                        echo'
                        <div id="englishDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>En. Alt Sayfa Adı</p>
                                <p><input type="text" name="en_subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>En. Alt Sayfa İçerik</p>
                                <p><textarea name="en_subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                                $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                                echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                        echo'
                        <div id="germanDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>De. Alt Sayfa Adı</p>
                                <p><input type="text" name="de_subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>De. Alt Sayfa İçerik</p>
                                <p><textarea name="de_subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                        echo'
                        <div id="russianDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>Ru. Alt Sayfa Adı</p>
                                <p><input type="text" name="ru_subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ru. Alt Sayfa İçerik</p>
                                <p><textarea name="ru_subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                        echo'
                        <div id="bulgarianDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>Bg. Alt Sayfa Adı</p>
                                <p><input type="text" name="bg_subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Bg. Alt Sayfa İçerik</p>
                                <p><textarea name="bg_subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                        echo'
                        <div id="arabianDil-Box">
                            <div class="SubPageMainCenter-Line2">
                                <p>Ar. Alt Sayfa Adı</p>
                                <p><input type="text" name="ar_subpage_name" /></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ar. Alt Sayfa İçerik</p>
                                <p><textarea name="ar_subpage_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Alt Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="subpage_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="SubPageMainCenter-Line2">
                                <button name="subpageGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                        ';
                    }
                    else { subpageAdd($pdo); }
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