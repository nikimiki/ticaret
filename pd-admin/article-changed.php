<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/ArticleChange.php');

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
        function pageSelectRadio(p) {
            document.getElementById('page_one').style.display = "none";
            document.getElementById('page_two').style.display = "none";
            document.getElementById('page_tree').style.display = "none";
            document.getElementById('page_four').style.display = "none";
            document.getElementById('page_five').style.display = "none";
            document.getElementById(p).style.display = "inline";
        }
    </script>
    <script type="text/javascript">
        function imageSelectRadio(i) {
            document.getElementById('image_one').style.display = "none";
            document.getElementById('image_two').style.display = "none";
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
					<p><a href="article-change.php"><i class="fa fa-reply"></i></a>YAZILAR | DEĞİŞTİR</p>
				</div>
				<div class="ArticleMainCenter2">
                    <?php
                        if(!isset($_POST['articleDegistir'])) {
                            $id = $_GET['articleChange'];
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
                            page.id as PID, page.page_name,
                            subpage.id as SubPID, subpage.subpage_name,
                            category.id as CID, category.category_name,
                            subcategory.id as SubCID, subcategory.subcategory_name,
                            users.id as UID, users.user_name
                            FROM article
                            LEFT JOIN page ON page.id = article.page_id
                            LEFT JOIN subpage ON subpage.id = article.subpage_id
                            LEFT JOIN category ON category.id = article.category_id
                            LEFT JOIN subcategory ON subcategory.id = article.subcategory_id
                            INNER JOIN users ON users.id = article.article_user
                            WHERE article.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                            $articleRow = $articleSQL;

                            $pageOne = "javascript:pageSelectRadio('page_one')";
                            $pageTwo = "javascript:pageSelectRadio('page_two')";
                            $pageTree = "javascript:pageSelectRadio('page_tree')";
                            $pageFour = "javascript:pageSelectRadio('page_four')";
                            $pageFive = "javascript:pageSelectRadio('page_five')";

                            $imageOne = "javascript:imageSelectRadio('image_one')";
                            $imageTwo = "javascript:imageSelectRadio('image_two')";

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
                                    <input type="radio" name="page_degis" value="0" onclick="'.$pageOne.'" checked="checked" /> Yeri değiştirme
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="page_degis" value="1" onclick="'.$pageTwo.'" unchecked /> Sayfaya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="page_degis" value="4" onclick="'.$pageFive.'" unchecked /> Alt Sayfaya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="page_degis" value="2" onclick="'.$pageTree.'" unchecked /> Kategoriye
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="page_degis" value="3" onclick="'.$pageFour.'" unchecked /> Alt Kategoriye
                                    <div id="page_one" class="ArticleSecenek" style="display: visible;"> <i class="fa fa-eye"></i> &nbsp;';
                            if(($articleRow['page_id'] == $articleRow['PID']) || ($articleRow['category_id'] == $articleRow['CID']) || ($articleRow['subcategory_id'] == $articleRow['SubCID']) || ($articleRow['subpage_id'] == $articleRow['SubPID'])) {
                                if($articleRow['page_id'] == $articleRow['PID']) { echo 'Sayfa - '.$articleRow['page_name']; }
                                elseif($articleRow['category_id'] == $articleRow['CID']) { echo 'Kategori - '.$articleRow['category_name']; }
                                elseif($articleRow['subcategory_id'] == $articleRow['SubCID']) { echo 'Alt Kategori - '.$articleRow['subcategory_name']; }
                                elseif($articleRow['subpage_id'] == $articleRow['SubPID']) { echo 'Alt Sayfa - '.$articleRow['subpage_name']; }
                            } else { echo 'Ekli olduğu bölüm yok !'; }

                            echo '  </div>
                                    <div id="page_two" class="ArticleSecenek" style="display: none;">
                                        <select name="page_id">
                                            <option value="0">Lütfen bir Sayfa seçiniz</option>';
                            $pageSQL = $pdo->prepare("SELECT id, page_name FROM page ORDER BY id DESC");
                            $pageSQL->execute();
                            $pageRec = $pageSQL->fetchAll();
                            foreach($pageRec as $pageRow) { echo '<option value="'.$pageRow['id'].'">'.$pageRow['page_name'].'</option>'; }
                            echo '
                                        </select>
                                    </div>
                                    <div id="page_five" class="ArticleSecenek" style="display: none;">
                                        <select name="subpage_id">
                                            <option value="0">Lütfen bir Alt Sayfa seçiniz</option>';
                            $subpageSQL = $pdo->prepare("SELECT id, subpage_name FROM subpage ORDER BY id DESC");
                            $subpageSQL->execute();
                            $subpageRec = $subpageSQL->fetchAll();
                            foreach($subpageRec as $subpageRow) { echo '<option value="'.$subpageRow['id'].'">'.$subpageRow['subpage_name'].'</option>'; }
                            echo '
                                        </select>
                                    </div>
                                    <div id="page_tree" class="ArticleSecenek" style="display: none;">
                                        <select name="category_id">
                                            <option value="0">Lütfen bir Kategori seçiniz</option>';
                            $categorySQL = $pdo->prepare("SELECT id, category_name FROM category ORDER BY id DESC");
                            $categorySQL->execute();
                            $categoryRec = $categorySQL->fetchAll();
                            foreach($categoryRec as $categoryRow) { echo '<option value="'.$categoryRow['id'].'">'.$categoryRow['category_name'].'</option>'; }
                            echo '
                                        </select>
                                    </div>
                                    <div id="page_four" class="ArticleSecenek" style="display: none;">
                                        <select name="subcategory_id">
                                            <option value="0">Lütfen bir Alt Kategori seçiniz</option>';
                            $subCategorySQL = $pdo->prepare("SELECT id, subcategory_name FROM subcategory ORDER BY id DESC");
                            $subCategorySQL->execute();
                            $subCategoryRec = $subCategorySQL->fetchAll();
                            foreach($subCategoryRec as $subcategory) { echo '<option value="'.$subcategory['id'].'">'.$subcategory['subcategory_name'].'</option>'; }
                            echo '
                                        </select>
                                    </div>
                                </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Başlığı</p>
                                <p><input type="text" name="article_name" value="'.$articleRow['article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Link</p>
                                <p><input type="text" name="article_link" value="'.$articleRow['article_link'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı İçerik</p>
                                <p><textarea name="article_info" class="ckeditor" id="editor1">'.$articleRow['article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Resim</p>
                                <p>
                                    <input type="radio" name="image_degis" value="0" onclick="'.$imageOne.'" checked="checked" /> Resim değiştirme
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="image_degis" value="1" onclick="'.$imageTwo.'" unchecked /> Resim değiştir
                                    <div id="image_one" class="ArticleSecenek" style="display: visible;">
                                        <img src="pic/'.$articleRow['article_picture'].'" alt="'.$articleRow['article_name'].' - Resmi" style="width:100px;height:70px;" />
                                    </div>
                                    <div id="image_two" class="ArticleSecenek" style="display: none;">
                                        <input type="file" name="article_picture" id="article_picture" />
                                    </div>
                                </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="englishDil-Box">
                            <div class="ArticleMainCenter-Line2">
                                <p>En. Yazı Başlığı</p>
                                <p><input type="text" name="en_article_name" value="'.$articleRow['en_article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>En. Yazı İçerik</p>
                                <p><textarea name="en_article_info" class="ckeditor" id="editor1">'.$articleRow['en_article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="germanDil-Box">
                            <div class="ArticleMainCenter-Line2">
                                <p>De. Yazı Başlığı</p>
                                <p><input type="text" name="de_article_name" value="'.$articleRow['de_article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>De. Yazı İçerik</p>
                                <p><textarea name="de_article_info" class="ckeditor" id="editor1">'.$articleRow['de_article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="russianDil-Box">
                            <div class="ArticleMainCenter-Line2">
                                <p>Ru. Yazı Başlığı</p>
                                <p><input type="text" name="ru_article_name" value="'.$articleRow['ru_article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Ru. Yazı İçerik</p>
                                <p><textarea name="ru_article_info" class="ckeditor" id="editor1">'.$articleRow['ru_article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="bulgarianDil-Box">
                            <div class="ArticleMainCenter-Line2">
                                <p>Bg. Yazı Başlığı</p>
                                <p><input type="text" name="bg_article_name" value="'.$articleRow['bg_article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Bg. Yazı İçerik</p>
                                <p><textarea name="bg_article_info" class="ckeditor" id="editor1">'.$articleRow['bg_article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="arabianDil-Box">
                            <div class="ArticleMainCenter-Line2">
                                <p>Ar. Yazı Başlığı</p>
                                <p><input type="text" name="ar_article_name" value="'.$articleRow['ar_article_name'].'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Ar. Yazı İçerik</p>
                                <p><textarea name="ar_article_info" class="ckeditor" id="editor1">'.$articleRow['ar_article_info'].'</textarea></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Yazı Ekleme</p>
                                <p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="article_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <p>Değiştirme Tarihi</p><p>'.$articleRow['article_date'].'<input type="hidden" value="'.$id.'"/></p>
                            </div>
                            <div class="ArticleMainCenter-Line2">
                                <button name="articleDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            </form>';
                        } else { articleChange($pdo); }
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