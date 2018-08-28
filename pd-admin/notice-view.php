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
	<link rel="stylesheet" type="text/css" href="css/notice.css">
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
                    $id = $_GET['noticeView'];
                    $noticeSQL = $pdo->query("SELECT
                    notice.id, notice.notice_name, notice.notice_info, notice.en_notice_name, notice.en_notice_info,
                    notice.de_notice_name, notice.de_notice_info, notice.ru_notice_name, notice.ru_notice_info,
                    notice.bg_notice_name, notice.bg_notice_info, notice.ar_notice_name, notice.ar_notice_info,
                    notice.notice_user, notice.notice_date, users.id, users.user_name
                    FROM notice
                    INNER JOIN users ON users.id = notice.notice_user
                    WHERE notice.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $noticeRow = $noticeSQL;
                ?>
				<div class="NoticeMainHeader">
					<p>DUYURULAR - <?php echo $noticeRow['notice_name']; ?><a href="notices.php"><i class="fa fa-reply"></i></a></p>
				</div>
				<div class="NoticeMainCenter2">
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>Duyuru Başlığı</p><p><?php echo $noticeRow['notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['notice_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>EN Duyuru Başlığı</p><p><?php echo $noticeRow['en_notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>EN Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['en_notice_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>DE Duyuru Başlığı</p><p><?php echo $noticeRow['de_notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>DE Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['de_notice_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>RU Duyuru Başlığı</p><p><?php echo $noticeRow['ru_notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>RU Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['ru_notice_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>BG Duyuru Başlığı</p><p><?php echo $noticeRow['bg_notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>BG Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['bg_notice_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="NoticeMainCenter-Line2">
                            <p>AR Duyuru Başlığı</p><p><?php echo $noticeRow['ar_notice_name']; ?></p>
                        </div>
                        <div class="NoticeMainCenter-Line2">
                            <p>AR Duyuru İçerik</p>
                            <p><?php echo strip_tags($noticeRow['ar_notice_info']); ?></p>
                        </div>
                    </div>
					<div class="NoticeMainCenter-Line2">
						<p>Duyuru Ekleme</p><p><?php echo $noticeRow['user_name']; ?></p>
					</div>
					<div class="NoticeMainCenter-Line2">
						<p>Ekleme Tarihi</p><p><?php echo $noticeRow['notice_date']; ?></p>
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