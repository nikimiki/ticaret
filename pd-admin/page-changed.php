<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/PageChange.php');

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
	<link rel="stylesheet" type="text/css" href="css/pages.css">
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
				<div class="PageMainHeader">
					<p><a href="pages.php"><i class="fa fa-reply"></i></a>SAYFALAR | DEĞİŞTİR</p>
				</div>
				<div class="PageMainCenter2">
                    <?php
                        if(!isset($_POST['pageDegistir'])) {
                            $id = $_GET['pageChange'];
                            $pageSQL = $pdo->query("SELECT
                            page.id as PID, page.page_name, page.page_info, page.en_page_name, page.en_page_info,  page.de_page_name, page.de_page_info,
                            page.ru_page_name, page.ru_page_info, page.bg_page_name, page.bg_page_info, page.ar_page_name, page.ar_page_info,
                            page.page_user, page.page_date,
                            users.id as UID, users.user_name
                            FROM page
                            INNER JOIN users ON page.page_user = users.id
                            WHERE page.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                            $pageRow = $pageSQL;
                            echo '
                                    <div id="turkceDil-Tab">TÜRKÇE</div>
                                    <div id="englishDil-Tab">ENGLISH</div>
                                    <div id="germanDil-Tab">GERMAN</div>
                                    <div id="russianDil-Tab">RUSSIAN</div>
                                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                                    <div id="arabianDil-Tab">ARABIAN</div>
                                    <form action="#" method="post">
                                    <div id="turkceDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Adı</p>
                                        <p><input type="text" name="page_name" value="'.$pageRow['page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa İçerik</p>
                                        <p><textarea name="page_info" class="ckeditor" id="editor1">'.$pageRow['page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>';
                            echo '
                            <div id="englishDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>En. Sayfa Adı</p>
                                        <p><input type="text" name="en_page_name" value="'.$pageRow['en_page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>En. Sayfa İçerik</p>
                                        <p><textarea name="en_page_info" class="ckeditor" id="editor1">'.$pageRow['en_page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                            ';
                            echo '
                            <div id="germanDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>De. Sayfa Adı</p>
                                        <p><input type="text" name="de_page_name" value="'.$pageRow['de_page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>De. Sayfa İçerik</p>
                                        <p><textarea name="de_page_info" class="ckeditor" id="editor1">'.$pageRow['de_page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                            ';
                            echo '
                            <div id="russianDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>Ru. Sayfa Adı</p>
                                        <p><input type="text" name="ru_page_name" value="'.$pageRow['ru_page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ru. Sayfa İçerik</p>
                                        <p><textarea name="ru_page_info" class="ckeditor" id="editor1">'.$pageRow['ru_page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                            ';
                            echo '
                            <div id="bulgarianDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>Bg. Sayfa Adı</p>
                                        <p><input type="text" name="bg_page_name" value="'.$pageRow['bg_page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Bg. Sayfa İçerik</p>
                                        <p><textarea name="bg_page_info" class="ckeditor" id="editor1">'.$pageRow['bg_page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                            ';
                            echo '
                            <div id="arabianDil-Box">
                                    <div class="PageMainCenter-Line2">
                                        <p>Ar. Sayfa Adı</p>
                                        <p><input type="text" name="ar_page_name" value="'.$pageRow['ar_page_name'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>AR. Sayfa İçerik</p>
                                        <p><textarea name="ar_page_info" class="ckeditor" id="editor1">'.$pageRow['ar_page_info'].'</textarea></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Sayfa Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                    <input type="hidden" name="page_user" value="'.$oturum['id'].'"/></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['page_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="PageMainCenter-Line2">
                                        <button name="pageDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    </form>
                            ';
                        } else { pageChange($pdo); }
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