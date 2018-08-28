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
	<link rel="stylesheet" type="text/css" href="css/article.css">
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
			<div class="SectionLeft" style="min-height: 1395px;">
				<?php PartLeft(); ?>
			</div>
			<div class="SectionConText">
                <?php
                    $id = $_GET['articleView'];
                    $articleSQL = $pdo->query("SELECT
                    article.id, article.category_id, article.page_id, article.subpage_id, article.subcategory_id,
                    article.article_name, article.article_info,
                    article.en_article_name, article.en_article_info,
                    article.de_article_name, article.de_article_info,
                    article.ru_article_name, article.ru_article_info,
                    article.bg_article_name, article.bg_article_info,
                    article.ar_article_name, article.ar_article_info,
                    article.article_link, article.article_picture,
                    article.article_user, article.article_date,
                    category.id as CID, category.category_name,
                    page.id as PID, page.page_name,
                    subpage.id as SubPID, subpage.subpage_name,
                    subcategory.id as SubCID, subcategory.subcategory_name,
                    users.id as UID, users.user_name
                    FROM article
                    LEFT JOIN category ON category.id = article.category_id
                    LEFT JOIN page ON page.id = article.page_id
                    LEFT JOIN subpage ON subpage.id = article.subpage_id
                    LEFT JOIN subcategory ON subcategory.id = article.subcategory_id
                    INNER JOIN users ON users.id = article.article_user
                    WHERE article.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $articleRow = $articleSQL;
                ?>
				<div class="ArticleMainHeader">
					<p>YAZILAR - <?php echo $articleRow['article_name']; ?><a href="articles.php"><i class="fa fa-reply"></i></a></p>
				</div>
				<div class="ArticleMainCenter2" style="min-height: 1300px;">
                    <img src="pic/<?php echo $articleRow['article_picture']; ?>" alt="<?php echo $articleRow['article_name']; ?> - Resim" />
					<div class="ArticleMainCenter-Line2">
                            <?php
                                if($articleRow['CID'] == $articleRow['category_id']) { echo '<p>Kategori Adı</p><p>'.$articleRow['category_name'].'</p>'; }
                                elseif($articleRow['PID'] == $articleRow['page_id']) { echo '<p>Sayfa Adı</p><p>'.$articleRow['page_name'].'</p>'; }
                                elseif($articleRow['SubPID'] == $articleRow['subpage_id']) { echo '<p>Alt Sayfa Adı</p><p>'.$articleRow['subpage_name'].'</p>'; }
                                elseif($articleRow['SubCID'] == $articleRow['subcategory_id']) { echo '<p>Alt Kategori Adı</p><p>'.$articleRow['subcategory_name'].'</p>'; }
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
                        <div class="ArticleMainCenter-Line2">
                            <p>Yazı Başlık</p><p><?php echo $articleRow['article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>Yazı Linki</p><p><?php echo $articleRow['article_link']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['article_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="ArticleMainCenter-Line2">
                            <p>EN Yazı Başlık</p><p><?php echo $articleRow['en_article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>EN Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['en_article_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="ArticleMainCenter-Line2">
                            <p>DE Yazı Başlık</p><p><?php echo $articleRow['de_article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>DE Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['de_article_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="ArticleMainCenter-Line2">
                            <p>RU Yazı Başlık</p><p><?php echo $articleRow['ru_article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>RU Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['ru_article_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="ArticleMainCenter-Line2">
                            <p>BG Yazı Başlık</p><p><?php echo $articleRow['bg_article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>BG Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['bg_article_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="ArticleMainCenter-Line2">
                            <p>AR Yazı Başlık</p><p><?php echo $articleRow['ar_article_name']; ?></p>
                        </div>
                        <div class="ArticleMainCenter-Line2">
                            <p>AR Yazı İçerik</p>
                            <p><?php echo strip_tags($articleRow['ar_article_info']); ?></p>
                        </div>
                    </div>
					<div class="ArticleMainCenter-Line2">
						<p>Yazı Ekleme</p><p><?php echo $articleRow['user_name']; ?></p>
					</div>
					<div class="ArticleMainCenter-Line2">
						<p>Ekleme Tarihi</p><p><?php echo $articleRow['article_date']; ?></p>
					</div>
				</div>
			</div>
			<div class="SectionRight" style="min-height: 1394px;">
				<?php PartRight($pdo); ?>
			</div>
		</section>
	</div>

</body>
</html>
<?php ob_end_flush(); ?>