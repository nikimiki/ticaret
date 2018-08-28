<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/NoticeAdd.php');

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
	<link rel="stylesheet" type="text/css" href="css/notice.css">
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
				<div class="NoticeMainHeader">
					<p><a href="notices.php"><i class="fa fa-reply"></i></a>DUYURULAR</p>
				</div>
				<div class="NoticeMainCenter2">
                    <?php
                        if(!isset($_POST['noticeGonder'])) {
                            echo '
                            <div id="turkceDil-Tab">TÜRKÇE</div>
                            <div id="englishDil-Tab">ENGLISH</div>
                            <div id="germanDil-Tab">GERMAN</div>
                            <div id="russianDil-Tab">RUSSIAN</div>
                            <div id="bulgarianDil-Tab">BULGARIAN</div>
                            <div id="arabianDil-Tab">ARABIAN</div>
                            <form action="#" method="post">
                            <div id="turkceDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Başlığı</p>
                                <p><input type="text" name="notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru İçerik</p>
                                <p><textarea name="notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="englishDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>En. Duyuru Başlığı</p>
                                <p><input type="text" name="en_notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>En. Duyuru İçerik</p>
                                <p><textarea name="en_notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="germanDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>De. Duyuru Başlığı</p>
                                <p><input type="text" name="de_notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>De. Duyuru İçerik</p>
                                <p><textarea name="de_notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="russianDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>Ru. Duyuru Başlığı</p>
                                <p><input type="text" name="ru_notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ru. Duyuru İçerik</p>
                                <p><textarea name="ru_notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="bulgarianDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>Bg. Duyuru Başlığı</p>
                                <p><input type="text" name="bg_notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Bg. Duyuru İçerik</p>
                                <p><textarea name="bg_notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="arabianDil-Box">
                            <div class="NoticeMainCenter-Line2">
                                <p>Ar. Duyuru Başlığı</p>
                                <p><input type="text" name="ar_notice_name" /></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ar. Duyuru İçerik</p>
                                <p><textarea name="ar_notice_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Duyuru Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="notice_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                            </div>
                            <div class="NoticeMainCenter-Line2">
                                <button name="noticeGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            </form>';
                        } else { noticeAdd($pdo); }
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