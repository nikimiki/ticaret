<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/ArticleAdd.php');

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
    <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
    <script type="text/javascript" src="js/dilSec.js"></script>
    <script type="text/javascript">
        function selectRadio(i) {
            document.getElementById('article_page').style.display = "none";
            document.getElementById('article_subpage').style.display = "none";
            document.getElementById('article_category').style.display = "none";
            document.getElementById('article_subcategory').style.display = "none";
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
				<div class="ArticleMainHeader">
					<p><a href="articles.php"><i class="fa fa-reply"></i></a>YAZILAR</p>
				</div>
				<div class="ArticleMainCenter2">

                    <?php
                        if(!isset($_POST['articleGonder'])) {
                            $artPage = "javascript:selectRadio('article_page')";
                            $artSPage = "javascript:selectRadio('article_subpage')";
                            $artCat = "javascript:selectRadio('article_category')";
                            $artSCat = "javascript:selectRadio('article_subcategory')";
                            echo '
                                <div id="turkceDil-Tab">TÜRKÇE</div>
                                <div id="englishDil-Tab">ENGLISH</div>
                                <div id="germanDil-Tab">GERMAN</div>
                                <div id="russianDil-Tab">RUSSIAN</div>
                                <div id="bulgarianDil-Tab">BULGARIAN</div>
                                <div id="arabianDil-Tab">ARABIAN</div>
                                <form action="#" method="post" enctype="multipart/form-data">
                                <div id="turkceDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>Eklenecek Yer</p>
                                    <p>
                                    <input type="radio" name="eklenecek_yer" value="0" onclick="'.$artPage.'" checked="checked" /> Sayfaya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                     <input type="radio" name="eklenecek_yer" value="3" onclick="'.$artSPage.'" unchecked /> Alt Sayfaya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="1" onclick="'.$artCat.'" unchecked /> Kategoriye
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="2" onclick="'.$artSCat.'" unchecked /> Alt Kategoriye
                                    <div id="article_page" class="ArticleSecenek" style="display: visible;">
                                        <select name="page_id">
                                            <option value="0">Lütfen bir Sayfa seçiniz</option>';
                                $PageSQL = $pdo->prepare("SELECT id, page_name FROM page ORDER BY id DESC");
                                $PageSQL->execute();
                                $PageRec = $PageSQL->fetchAll();
                                foreach($PageRec as $PageRecord) {
                                    echo '<option value="'. $PageRecord['id'] .'">' . $PageRecord['page_name'] . '</option>';
                                }
                            echo '
                                    </select>
                                </div>
                                <div id="article_subpage" class="ArticleSecenek" style="display: none;">
                                        <select name="subpage_id">
                                            <option value="0">Lütfen bir Alt Sayfa seçiniz</option>';
                                $SubPageSQL = $pdo->prepare("SELECT id, subpage_name FROM subpage ORDER BY id DESC");
                                $SubPageSQL->execute();
                                $SubPageRec = $SubPageSQL->fetchAll();
                                foreach($SubPageRec as $SubPageRecord) {
                                    echo '<option value="'. $SubPageRecord['id'] .'">' . $SubPageRecord['subpage_name'] . '</option>';
                                }
                            echo '
                                    </select>
                                </div>
                                <div id="article_category" class="ArticleSecenek" style="display: none;">
                                    <select name="category_id">
                                        <option value="0">Lütfen bir Kategori seçiniz</option>';
                                $CatSQL = $pdo->prepare("SELECT id, category_name FROM category ORDER BY id DESC");
                                $CatSQL->execute();
                                $CatRec = $CatSQL->fetchAll();
                                foreach($CatRec as $CatRecord) {
                                    echo '<option value="'.$CatRecord['id'].'">'.$CatRecord['category_name'].'</option>';
                                }
                            echo '
                                        </select>
                                    </div>
                                    <div id="article_subcategory" class="ArticleSecenek" style="display: none;">
                                        <select name="subcategory_id">
                                            <option value="0">Lütfen bir Alt Kategori seçiniz</option>';
                                $subCatSQL = $pdo->prepare("SELECT id, subcategory_name FROM subcategory ORDER BY id DESC");
                                $subCatSQL->execute();
                                $subCatRec = $subCatSQL->fetchAll();
                                foreach($subCatRec as $SCatRecord) {
                                    echo '<option value="'.$SCatRecord['id'].'">'.$SCatRecord['subcategory_name'].'</option>';
                                }
                            echo '      </select>
                                    </div>
                                    </p>
                                </div>
                            ';
                            echo '
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Başlığı</p>
                                    <p><input type="text" name="article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Linki</p>
                                    <p><input type="text" name="article_link" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı İçerik</p>
                                    <p><textarea name="article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Resim</p>
                                    <p><input type="file" name="article_picture" id="article_picture" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="englishDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>En. Yazı Başlığı</p>
                                    <p><input type="text" name="en_article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>En. Yazı İçerik</p>
                                    <p><textarea name="en_article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="germanDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>De. Yazı Başlığı</p>
                                    <p><input type="text" name="de_article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>De. Yazı İçerik</p>
                                    <p><textarea name="de_article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="russianDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ru. Yazı Başlığı</p>
                                    <p><input type="text" name="ru_article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ru. Yazı İçerik</p>
                                    <p><textarea name="ru_article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="bulgarianDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>Bg. Yazı Başlığı</p>
                                    <p><input type="text" name="bg_article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Bg. Yazı İçerik</p>
                                    <p><textarea name="bg_article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="arabianDil-Box">
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ar. Yazı Başlığı</p>
                                    <p><input type="text" name="ar_article_name" /></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ar. Yazı İçerik</p>
                                    <p><textarea name="ar_article_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Yazı Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="ArticleMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>';
                            echo date("d.m.Y");
                            echo '
                                </p></div>
                                <div class="ArticleMainCenter-Line2">
                                    <button name="articleGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                </form>
                            ';
                        } else { articleAdd($pdo); }
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