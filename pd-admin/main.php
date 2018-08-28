<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/TotalMainInformation.php');
    include('includes/CommentView.php');
    include('includes/SpecialTotalInfo.php');
    include('includes/siteOptions.php');

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
	<link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/menu-collapsed.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/metaDegis.js"></script>
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
				<div class="PoemaInformationTab">
					<p><i class="fa fa-bell-o"></i>Admin Paneli Bilgileri | Poema Design Creative Agency</p>
                    <iframe src="http://musteri.poemadesign.com/muster-bilgilendirme.html"scrolling="no"></iframe>
                    <p><i class="fa fa-rss"></i><a href="http://www.poemadesign.com" target="_blank">www.poemadesign.com</a></p>
					<p><i class="fa fa-at"></i><a href="mailto:info@poemadesign.com">info@poemadesign.com</a></p>
					<p><i class="fa fa-phone"></i>+9 0539 397 68 98</p>
				</div>
				<div class="MainInformationTab">
					<p>Merhaba <b style="color:#ed6c44;font-weight: 300;"><?php YourName($pdo) ?></b>, Toplamda size ait</p>
                    <p><i class="fa fa-file-o"></i><?php SpecialTotalPage($pdo); ?> Sayfa</p>
					<p><i class="fa fa-folder-o"></i><?php SpecialTotalCategory($pdo); ?> Kategori</p>
                    <p><i class="fa fa-pencil"></i><?php SpecialTotalArticle($pdo); ?> Yazı</p>
					<p><i class="fa fa-bullhorn"></i><?php SpecialTotalNotice($pdo); ?> Duyuru</p>
					<p>bulunmaktadır.</p>
				</div>
				<div class="MainStaticTab">
					<p><i class="fa fa-area-chart"></i>Toplam Veriler</p>
					<p><i class="fa fa-file-o"></i><?php pageTotalCount($pdo); ?> &nbsp; Sayfa</p>
                    <p><i class="fa fa-files-o"></i><?php subpageTotalCount($pdo); ?> &nbsp; Alt Sayfa</p>
					<p><i class="fa fa-folder-o"></i><?php categoryTotalCount($pdo); ?> &nbsp; Kategori</p>
                    <p><i class="fa fa-folder-open-o"></i><?php subcategoryTotalCount($pdo); ?> &nbsp; Alt Kategori</p>
					<p><i class="fa fa-pencil"></i><?php articleTotalCount($pdo); ?> &nbsp; Yazı</p>
					<p><i class="fa fa-picture-o"></i><?php pictureTotalCount($pdo); ?> &nbsp; Görsel</p>
					<p><i class="fa fa-film" style="-webkit-transform: rotate(130deg);"></i><?php videoTotalCount($pdo); ?> &nbsp; Video</p>
					<p><i class="fa fa-users"></i><?php userTotalCount($pdo); ?> &nbsp; Üye</p>
					<p><i class="fa fa-comments-o"></i><?php commentTotalCount($pdo); ?> &nbsp; Yorum</p>
					<p><i class="fa fa-bullhorn"></i><?php noticeTotalCount($pdo); ?> &nbsp; Duyuru</p>
                    <p><i class="fa fa-film" style="-webkit-transform: rotate(90deg);"></i><?php sliderTotalCount($pdo); ?> &nbsp; Slider Resim</p>
					<p><i class="fa fa-envelope-o"></i><?php emailTotalCount($pdo); ?> &nbsp; E-Mail</p>
                    <p><i class="fa fa-calendar"></i><?php muayeneTotalCount($pdo); ?> &nbsp; Muayene Talebi</p>
                    <p><i class="fa fa-line-chart"></i><?php analizTotalCount($pdo); ?> &nbsp; Foto Analiz</p>
                    <p><i class="fa fa-question"></i><?php soruTotalCount($pdo); ?> &nbsp; Soru Formu</p>

				</div>
				<div class="MainStaticTab2">
                    <?php SpecialForYou($pdo); ?>
				</div>
                <div class="MainStaticTab3">
                    <p><i class="fa fa-comments-o"></i>Site Ayrıntıları</p>
                    <?php siteOption($pdo); ?>
                </div>
				<!--<div class="MainStaticTab3">
					<p><i class="fa fa-comments-o"></i>Onay bekleyen yorumlar</p>
					<p>Not: Yorumların üzerine tıklayarak yorumlar hakkında ayrıntılı bilgi alabilirsiniz.</p>
					<?php commentView($pdo); ?>
				</div>-->
			</div>
			<div class="SectionRight">
				<?php PartRight($pdo); ?>
			</div>
		</section>
	</div>

</body>
</html>
<?php ob_end_flush(); ?>