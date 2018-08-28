<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/CategoryAdd.php');

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
    <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
    <script type="text/javascript" src="js/dilSec.js"></script>
    <script type="text/javascript">
        function selectRadio(i) {
            document.getElementById('category_page').style.display = "none";
            document.getElementById('category_subpage').style.display = "none";
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
				<div class="CategoryMainHeader">
					<p><a href="categorys.php"><i class="fa fa-reply"></i></a>KATEGORİLER</p>
				</div>
				<div class="CategoryMainCenter2">
                    <?php
                        if(!isset($_POST['categoryGonder'])) {
                            $catPage = "javascript:selectRadio('category_page')";
                            $catSubPage = "javascript:selectRadio('category_subpage')";
                            echo '
                                <div id="turkceDil-Tab">TÜRKÇE</div>
                                <div id="englishDil-Tab">ENGLISH</div>
                                <div id="germanDil-Tab">GERMAN</div>
                                <div id="russianDil-Tab">RUSSIAN</div>
                                <div id="bulgarianDil-Tab">BULGARIAN</div>
                                <div id="arabianDil-Tab">ARABIAN</div>
                                <form action="#" method="post">
                                <div id="turkceDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>Eklenecek Yer</p>
                                    <p>
                                    <input type="radio" name="eklenecek_yer" value="0" onclick="'.$catPage.'" checked="checked" /> Sayfaya
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="eklenecek_yer" value="1" onclick="'.$catSubPage.'" unchecked /> Alt Sayfaya
                                    <div id="category_page" class="CategorySecenek" style="display: visible;">
                                    <select name="page_id">
                                    <option value="0">Lütfen Sayfa seçiniz</option>';
                                    $pageSql = $pdo->prepare("SELECT id, page_name FROM page");
                                    $pageSql->execute();
                                    $PageRecords = $pageSql->fetchAll();
                                    foreach($PageRecords as $page){
                                        echo '<option value="'.$page['id'].'">'.$page['page_name'].'</option>';
                                    }
                                echo '</select>
                                      </div>
                                      <div id="category_subpage" class="CategorySecenek" style="display: none;">
                                      <select name="subpage_id">
                                      <option value="0">Lütfen Alt Sayfa seçiniz</option>';
                                    $subpageSql = $pdo->prepare("SELECT subpage.id as SPID, subpage.page_id, subpage.subpage_name, page.id as PID, page.page_name
                                    FROM subpage
                                    LEFT JOIN page ON page.id = subpage.page_id");
                                    $subpageSql->execute();
                                    $SubPageRecords = $subpageSql->fetchAll();
                                    foreach($SubPageRecords as $Spage){
                                        $baslik = $Spage['page_name'];
                                        $ara = array('İ', 'I');
                                        $bul = array('i', 'ı');
                                        $yeni_baslik = str_replace($ara, $bul, $baslik);
                                        echo '<option value="'.$Spage['SPID'].'"> '.ucfirst(strtolower($yeni_baslik)).'  - '.$Spage['subpage_name'].'</option>';
                                    }
                                echo '
                                        </select>
                                        </div>
                                      </p>
                                      </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Adı</p>
                                    <p><input type="text" name="category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori İçerik</p>
                                    <p><textarea name="category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="englishDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>En. Kategori Adı</p>
                                    <p><input type="text" name="en_category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>En. Kategori İçerik</p>
                                    <p><textarea name="en_category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="germanDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>De. Kategori Adı</p>
                                    <p><input type="text" name="de_category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>De. Kategori İçerik</p>
                                    <p><textarea name="de_category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="russianDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ru. Kategori Adı</p>
                                    <p><input type="text" name="ru_category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ru. Kategori İçerik</p>
                                    <p><textarea name="ru_category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="bulgarianDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>Bg. Kategori Adı</p>
                                    <p><input type="text" name="bg_category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Bg. Kategori İçerik</p>
                                    <p><textarea name="bg_category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                            <div id="arabianDil-Box">
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ar. Kategori Adı</p>
                                    <p><input type="text" name="ar_category_name" /></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ar. Kategori İçerik</p>
                                    <p><textarea name="ar_category_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                                <input type="hidden" name="category_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="CategoryMainCenter-Line2">
                                    <button name="categoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                </form>';
                        } else { categoryAdd($pdo); }
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