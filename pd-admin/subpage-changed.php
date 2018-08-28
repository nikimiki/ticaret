<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/SubPageChange.php');

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
        <script type="text/javascript">
            function subpageRadio(i) {
                document.getElementById('page_one').style.display = "none";
                document.getElementById('page_two').style.display = "none";
                document.getElementById(i).style.display = "inline";
            }
        </script>
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
                    <p><a href="subpage-change.php"><i class="fa fa-reply"></i></a>ALT SAYFALAR | DEĞİŞTİR</p>
                </div>
                <div class="SubPageMainCenter2">
                    <?php
                    if(!isset($_POST['subpageDegistir'])) {
                        $id = $_GET['subPageChange'];
                        $pageSQL = $pdo->query("SELECT
                           subpage.id as SubPID, subpage.page_id,
                           subpage.subpage_name, subpage.subpage_info, subpage.en_subpage_name, subpage.en_subpage_info,
                           subpage.de_subpage_name, subpage.de_subpage_info, subpage.ru_subpage_name, subpage.ru_subpage_info,
                           subpage.bg_subpage_name, subpage.bg_subpage_info, subpage.ar_subpage_name, subpage.ar_subpage_info,
                           subpage.subpage_date, subpage.subpage_user,
                           page.id as PID, page.page_name,
                           users.id as UID, users.user_name
                           FROM subpage
                           LEFT JOIN page ON subpage.page_id = page.id
                           INNER JOIN users ON subpage.subpage_user = users.id
                           WHERE subpage.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                        $pageRow = $pageSQL;

                        $pageOne = "javascript:subpageRadio('page_one')";
                        $pageTwo = "javascript:subpageRadio('page_two')";

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
                                            <input type="radio" name="page_degis" value="0" onclick="'.$pageOne.'" checked="checked" /> Yeri değiştirme
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="page_degis" value="1" onclick="'.$pageTwo.'" unchecked /> Sayfaya
                                            <div id="page_one" class="SubPageSecenek" style="display: visible;"> <i class="fa fa-eye"></i> &nbsp;';
                        if($pageRow['PID'] == $pageRow['page_id']) { echo 'Sayfa - '.$pageRow['page_name']; }
                        else { echo '<i class="fa fa-fire" style="color: #F0310C;" title="Eklendiği yer bulunamadı !"></i>'; }

                        echo '               </div>
                                             <div id="page_two" class="SubPageSecenek" style="display: none;">
                                                <select name="page_id">
                                                    <option value="0">Lütfen bir Sayfa seçiniz</option>';
                        $subpageSQL = $pdo->prepare("SELECT id, page_name FROM page");
                        $subpageSQL->execute();
                        $subpageRec = $subpageSQL->fetchAll();
                        foreach($subpageRec as $subpageRow) { echo '<option value="'.$subpageRow['id'].'">'.$subpageRow['page_name'].'</option>'; }
                        echo '                   </select>
                                             </div>
                                        </p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Alt Sayfa Adı</p>
                                        <p><input type="text" name="subpage_name" value="'.$pageRow['subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Alt Sayfa İçerik</p>
                                        <p><textarea name="subpage_info" class="ckeditor" id="editor1">'.$pageRow['subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="englishDil-Box">
                                    <div class="SubPageMainCenter-Line2">
                                        <p>En. Alt Sayfa Adı</p>
                                        <p><input type="text" name="en_subpage_name" value="'.$pageRow['en_subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>En. Alt Sayfa İçerik</p>
                                        <p><textarea name="en_subpage_info" class="ckeditor" id="editor1">'.$pageRow['en_subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="germanDil-Box">
                                    <div class="SubPageMainCenter-Line2">
                                        <p>De. Alt Sayfa Adı</p>
                                        <p><input type="text" name="de_subpage_name" value="'.$pageRow['de_subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>De. Alt Sayfa İçerik</p>
                                        <p><textarea name="de_subpage_info" class="ckeditor" id="editor1">'.$pageRow['de_subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="russianDil-Box">
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Ru. Alt Sayfa Adı</p>
                                        <p><input type="text" name="ru_subpage_name" value="'.$pageRow['ru_subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Ru. Alt Sayfa İçerik</p>
                                        <p><textarea name="ru_subpage_info" class="ckeditor" id="editor1">'.$pageRow['ru_subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="bulgarianDil-Box">
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Bg. Alt Sayfa Adı</p>
                                        <p><input type="text" name="bg_subpage_name" value="'.$pageRow['bg_subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Bg. Alt Sayfa İçerik</p>
                                        <p><textarea name="bg_subpage_info" class="ckeditor" id="editor1">'.$pageRow['bg_subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="arabianDil-Box">
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Ar. Alt Sayfa Adı</p>
                                        <p><input type="text" name="ar_subpage_name" value="'.$pageRow['ar_subpage_name'].'"/></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <p>Ar. Alt Sayfa İçerik</p>
                                        <p><textarea name="ar_subpage_info" class="ckeditor" id="editor1">'.$pageRow['ar_subpage_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['subpage_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SubPageMainCenter-Line2">
                                        <button name="subpageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    </form>';
                    } else { subpageChange($pdo); }
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