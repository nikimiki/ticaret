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
	<link rel="stylesheet" type="text/css" href="css/category.css">
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
                    $id = $_GET['categoryView'];
                    $categorySQL = $pdo->query("SELECT
                    category.id as CID, category.page_id, category.subpage_id, category.category_name, category.category_info,
                    category.en_category_name, category.en_category_info,
                    category.de_category_name, category.de_category_info,
                    category.ru_category_name, category.ru_category_info,
                    category.bg_category_name, category.bg_category_info,
                    category.ar_category_name, category.ar_category_info,
                    category.category_user, category.category_date,
                    page.id as PID, page.page_name,
                    subpage.id as SubPID, subpage.subpage_name,
                    users.id as UID, users.user_name
                    FROM category
                    LEFT JOIN page ON page.id = category.page_id
                    LEFT JOIN subpage ON subpage.id = category.subpage_id
                    INNER JOIN users ON users.id = category.category_user
                    WHERE category.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $categoryRow = $categorySQL;
                ?>
				<div class="CategoryMainHeader">
					<p>KATEGORİLER - <?php echo $categoryRow['category_name']; ?><a href="categorys.php"><i class="fa fa-reply"></i></a></p>
				</div>
				<div class="CategoryMainCenter2">
					<div class="CategoryMainCenter-Line2">
                        <?php
                            if($categoryRow['PID'] == $categoryRow['page_id']) { echo '<p>Sayfa Adı</p><p>'.$categoryRow['page_name'].'</p>'; }
                            elseif($categoryRow['SubPID'] == $categoryRow['subpage_id']) { echo '<p>Alt Sayfa Adı</p><p>'.$categoryRow['subpage_name'].'</p>'; }
                            else { echo '<p>Eklendiği Yer</p><p>Ekli olduğu yer bulunamadı !</p>'; }
                        ?>
					</div>
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>Kategori Adı</p><p><?php echo $categoryRow['category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['category_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>EN Kategori Adı</p><p><?php echo $categoryRow['en_category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>EN Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['en_category_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>DE Kategori Adı</p><p><?php echo $categoryRow['de_category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>DE Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['de_category_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>RU Kategori Adı</p><p><?php echo $categoryRow['ru_category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>RU Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['ru_category_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>BG Kategori Adı</p><p><?php echo $categoryRow['bg_category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>BG Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['bg_category_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="CategoryMainCenter-Line2">
                            <p>AR Kategori Adı</p><p><?php echo $categoryRow['ar_category_name']; ?></p>
                        </div>
                        <div class="CategoryMainCenter-Line2">
                            <p>AR Kategori İçerik</p>
                            <p><?php echo strip_tags($categoryRow['ar_category_info']); ?></p>
                        </div>
                    </div>
					<div class="CategoryMainCenter-Line2">
						<p>Kategori Ekleme</p><p><?php echo $categoryRow['user_name']; ?></p>
					</div>
					<div class="CategoryMainCenter-Line2">
						<p>Ekleme Tarihi</p><p><?php echo $categoryRow['category_date']; ?></p>
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