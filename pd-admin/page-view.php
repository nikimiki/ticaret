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
	<link rel="stylesheet" type="text/css" href="css/pages.css">
	<link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/menu-collapsed.js"></script>
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
                <?php
                    $id = $_GET['pageView'];
                    $pageSQL = $pdo->query("SELECT
                    page.id, page.page_name, page.page_info, page.en_page_name, page.en_page_info, page.de_page_name, page.de_page_info,
                     page.ru_page_name, page.ru_page_info, page.bg_page_name, page.bg_page_info, page.ar_page_name, page.ar_page_info,
                     page.page_user, page.page_date, users.id, users.user_name
                    FROM page
                    INNER JOIN users ON users.id = page.page_user
                    WHERE page.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $pageRow = $pageSQL;
                ?>
				<div class="PageMainHeader">
					<p>SAYFALAR - <?php echo $pageRow['page_name']; ?><a href="pages.php"><i class="fa fa-reply"></i></a></p>
				</div>
				<div class="PageMainCenter2">
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>Sayfa Adı</p><p><?php echo strip_tags($pageRow['page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['page_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>EN Sayfa Adı</p><p><?php echo strip_tags($pageRow['en_page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>EN Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['en_page_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>DE Sayfa Adı</p><p><?php echo strip_tags($pageRow['de_page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>DE Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['de_page_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>RU Sayfa Adı</p><p><?php echo strip_tags($pageRow['ru_page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>RU Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['ru_page_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>BG Sayfa Adı</p><p><?php echo strip_tags($pageRow['bg_page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>BG Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['bg_page_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="PageMainCenter-Line2">
                            <p>AR Sayfa Adı</p><p><?php echo strip_tags($pageRow['ar_page_name']); ?></p>
                        </div>
                        <div class="PageMainCenter-Line2">
                            <p>AR Sayfa İçerik</p>
                            <p><?php echo strip_tags($pageRow['ar_page_info']); ?></p>
                        </div>
                    </div>
					<div class="PageMainCenter-Line2">
						<p>Sayfa Ekleme</p><p><?php echo $pageRow['user_name']; ?></p>
					</div>
					<div class="PageMainCenter-Line2">
						<p>Ekleme Tarihi</p><p><?php echo $pageRow['page_date']; ?></p>
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