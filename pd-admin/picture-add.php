<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/PictureAdd.php');

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
	<link rel="stylesheet" type="text/css" href="css/picture.css">
	<link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/menu-collapsed.js"></script>
    <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
    <script type="text/javascript" src="js/dilSec.js"></script>
    <script type="text/javascript">
        function radioSelectText(i) {
            document.getElementById('picture_article').style.display = "none";
            document.getElementById('picture_category').style.display = "none";
            document.getElementById('picture_subcategory').style.display = "none";
            document.getElementById('picture_pic').style.display = "none";
            document.getElementById(i).style.display ='inline';
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
				<div class="PictureMainHeader">
					<p><a href="pictures.php"><i class="fa fa-reply"></i></a>MEDYA GÖRSEL | EKLE</p>
				</div>
				<div class="PictureMainCenter2">
                    <?php
                        if(!isset($_POST['pictureGonder'])) {
                            $picArt = "javascript:radioSelectText('picture_article')";
                            $picCat = "javascript:radioSelectText('picture_category')";
                            $picSubCat = "javascript:radioSelectText('picture_subcategory')";
                            $picPic = "javascript:radioSelectText('picture_pic')";
                            echo '
                            <div id="turkceDil-Tab">TÜRKÇE</div>
                            <div id="englishDil-Tab">ENGLISH</div>
                            <div id="germanDil-Tab">GERMAN</div>
                            <div id="russianDil-Tab">RUSSIAN</div>
                            <div id="bulgarianDil-Tab">BULGARIAN</div>
                            <div id="arabianDil-Tab">ARABIAN</div>
                            <form action="#" method="post" enctype="multipart/form-data">
                            <div id="turkceDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>Eklenecek Yer</p>
                                <p>
                                    <input type="radio" name="eklenecek_yer" value="0" onclick="'.$picArt.'" checked="checked" /> Yazıya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="1" onclick="'.$picCat.'" unchecked /> Kategoriye
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="2" onclick="'.$picSubCat.'" unchecked /> Alt Kategoriye
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="3" onclick="'.$picPic.'" unchecked /> Resimlere
                                    <div id="picture_article" class="PictureSecenek" style="display: visible;">
                                        <select name="article_id">
                                            <option value="0">Lütfen bir Yazı seçiniz</option>
                            ';
                            $articleSQL = $pdo->prepare("SELECT id, article_name FROM article ORDER BY id DESC");
                            $articleSQL->execute();
                            $articleFetch = $articleSQL->fetchAll();
                            foreach($articleFetch as $articleView) {
                                echo '<option value="'.$articleView['id'].'">'.$articleView['article_name'].'</option>';
                            }
                            echo '
                                        </select>
                                    </div>
                                    <div id="picture_category" class="PictureSecenek" style="display: none;">
                                        <select name="category_id">
                                            <option value="0">Lütfen bir Kategori seçiniz</option>
                            ';
                            $categorySQL = $pdo->prepare("SELECT id, category_name FROM category ORDER BY id DESC");
                            $categorySQL->execute();
                            $categoryFetch = $categorySQL->fetchAll();
                            foreach($categoryFetch as $categoryView) {
                                echo '<option value="'.$categoryView['id'].'">'.$categoryView['category_name'].'</option>';
                            }
                            echo '
                                        </select>
                                    </div>
                                    <div id="picture_subcategory" class="PictureSecenek" style="display: none;">
                                        <select name="subcategory_id">
                                            <option value="0">Lütfen bir Alt Kategori seçiniz</option>
                            ';
                            $subcategorySQL = $pdo->prepare("SELECT id, subcategory_name FROM subcategory ORDER BY id DESC");
                            $subcategorySQL->execute();
                            $subcategoryFetch = $subcategorySQL->fetchAll();
                            foreach($subcategoryFetch as $subcategoryView) {
                                echo '<option value="'.$subcategoryView['id'].'">'.$subcategoryView['subcategory_name'].'</option>';
                            }
                            echo '
                                        </select>
                                    </div>
                                    <div id="picture_pic" class="PictureSecenek" style="display: none;">
                                        Resimlere eklenecek.
                                    </div>
                                </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Başlık</p>
                                <p><input type="text" name="picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim İçerik</p>
                                <p><textarea name="picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim</p>
                                <p><input type="file" name="picture" id="picture" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="englishDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>En. Resim Başlık</p>
                                <p><input type="text" name="en_picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>En. Resim İçerik</p>
                                <p><textarea name="en_picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="germanDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>De. Resim Başlık</p>
                                <p><input type="text" name="de_picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>De. Resim İçerik</p>
                                <p><textarea name="de_picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="russianDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>Ru. Resim Başlık</p>
                                <p><input type="text" name="ru_picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ru. Resim İçerik</p>
                                <p><textarea name="ru_picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="bulgarianDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>Bg. Resim Başlık</p>
                                <p><input type="text" name="bg_picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Bg. Resim İçerik</p>
                                <p><textarea name="bg_picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            <div id="arabianDil-Box">
                            <div class="PictureMainCenter-Line2">
                                <p>Ar. Resim Başlık</p>
                                <p><input type="text" name="ar_picture_name" /></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ar. Resim İçerik</p>
                                <p><textarea name="ar_picture_info" class="ckeditor" id="editor1"></textarea></p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Resim Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                            <input type="hidden" name="picture_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo'</p>
                            </div>
                            <div class="PictureMainCenter-Line2">
                                <button name="pictureGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                            </div>
                            </div>
                            </form>';
                            } else { echo pictureAdd($pdo); }
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