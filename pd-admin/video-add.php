<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/VideoAdd.php');

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
    <link rel="stylesheet" type="text/css" href="css/video.css">
    <link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
    <script type="text/javascript" src="js/menu-collapsed.js"></script>
    <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
    <script type="text/javascript" src="js/dilSec.js"></script>
    <script type="text/javascript">
        function radioWithText(d) {
            document.getElementById('video_link').style.display = "none";
            document.getElementById('video_linksiz').style.display = "none";
            document.getElementById(d).style.display ='inline';
        }
    </script>
    <script type="text/javascript">
        function radioSelectText(i) {
            document.getElementById('video_yazi').style.display = "none";
            document.getElementById('video_video').style.display = "none";
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
        <div class="SectionLeft" style="padding-bottom: 88px;">
            <?php PartLeft(); ?>
        </div>
        <div class="SectionConText">
            <div class="VideoMainHeader">
                <p><a href="videos.php"><i class="fa fa-reply"></i></a>MEDYA VİDEO | EKLE</p>
            </div>
            <div class="VideoMainCenter2" style="padding-bottom: 70px;">
                <?php
                    if(!isset($_POST['videoGonder'])) {
                        $vidYaz = "javascript:radioSelectText('video_yazi')";
                        $vidVid = "javascript:radioSelectText('video_video')";
                        echo '
                        <div id="turkceDil-Tab">TÜRKÇE</div>
                        <div id="englishDil-Tab">ENGLISH</div>
                        <div id="germanDil-Tab">GERMAN</div>
                        <div id="russianDil-Tab">RUSSIAN</div>
                        <div id="bulgarianDil-Tab">BULGARIAN</div>
                        <div id="arabianDil-Tab">ARABIAN</div>
                        <form action="#" method="post" enctype="multipart/form-data">
                        <div id="turkceDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>Eklenecek Yer</p>
                            <p>
                                <input type="radio" name="eklenecek_yer" value="-1" onclick="'.$vidYaz.'" checked="checked" /> Yazıya ekle
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="eklenecek_yer" value="0" onclick="'.$vidVid.'" unchecked /> Videolara ekle

                                <div id="video_yazi" class="VideoSecenek" style="display: visible;">
                                    <select name="article_id">
                                        <option value="0">Lütfen bir yazı seçiniz</option>
                        ';
                        $articleSQL = $pdo->prepare("SELECT id, article_name FROM article ORDER BY id DESC");
                        $articleSQL->execute();
                        $articleShow = $articleSQL->fetchAll();
                        foreach($articleShow as $article) {
                            echo ' <option value = "' . $article['id'] . '">' . $article["article_name"] . ' </option> ';
                        }
                        echo '
                                    </select>
                                </div>
                                <div id="video_video" class="VideoSecenek" style="display: none;">
                                    Videolara eklenecek.
                                </div>
                            </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Başlık</p>
                            <p><input type="text" name="video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video İçerik</p>
                            <p><textarea name="video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video</p>
                            <p>
                                <input type="radio" name="video_tur" value="Radiobutton1" onclick="javascript:radioWithText("video_link")" checked="checked" /> Link ekle

                                <div id="video_link" class="VideoSecenek" style="display:visible;">
                                    <span>Link</span><input type="text" name="video_link">
                                </div>
                            </p>

                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="englishDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>En. Video Başlık</p>
                            <p><input type="text" name="en_video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>En. Video İçerik</p>
                            <p><textarea name="en_video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="germanDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>De. Video Başlık</p>
                            <p><input type="text" name="de_video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>De. Video İçerik</p>
                            <p><textarea name="de_video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="russianDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>Ru. Video Başlık</p>
                            <p><input type="text" name="ru_video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ru. Video İçerik</p>
                            <p><textarea name="ru_video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="bulgarianDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>Bg. Video Başlık</p>
                            <p><input type="text" name="bg_video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Bg. Video İçerik</p>
                            <p><textarea name="bg_video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="arabianDil-Box">
                        <div class="VideoMainCenter-Line2">
                            <p>Ar. Video Başlık</p>
                            <p><input type="text" name="ar_video_name" /></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ar. Video İçerik</p>
                            <p><textarea name="ar_video_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Video Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="video_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                        </div>
                        <div class="VideoMainCenter-Line2">
                            <button name="videoGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        </form>';
                        } else { echo videoAdd($pdo); }
                ?>
            </div>
        </div>
        <div class="SectionRight" style="padding-bottom: 89px;">
            <?php PartRight($pdo); ?>
        </div>
    </section>
    </div>

</body>
</html>
<?php ob_end_flush(); ?>