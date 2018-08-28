<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/SubCategoryChange.php');

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
        <link rel="stylesheet" type="text/css" href="css/subcategory.css">
        <link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
        <script type="text/javascript" src="js/menu.js"></script>
        <script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
        <script type="text/javascript" src="js/menu-collapsed.js"></script>
        <script type="text/javascript" src="ckeditor-st/ckeditor.js"></script>
        <script type="text/javascript" src="js/dilSec.js"></script>
        <script type="text/javascript">
            function selectRadio(i) {
                document.getElementById('category_one').style.display = "none";
                document.getElementById('category_two').style.display = "none";
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
                <div class="SubCategoryMainHeader">
                    <p><a href="subcategory-change.php"><i class="fa fa-reply"></i></a>ALT KATEGORİLER | DEĞİŞTİR</p>
                </div>
                <div class="SubCategoryMainCenter2">
                    <?php
                    if(!isset($_POST['subcategoryDegistir'])) {
                        $id = $_GET['subCategoryChange'];
                        $subCategorySQL = $pdo->query("SELECT
                            category.id as CID, category.category_name, users.id as UID, users.user_name,
                            subcategory.id as SubCID, subcategory.category_id, subcategory.subcategory_name, subcategory.subcategory_info,
                            subcategory.en_subcategory_name, subcategory.en_subcategory_info, subcategory.de_subcategory_name, subcategory.de_subcategory_info,
                            subcategory.ru_subcategory_name, subcategory.ru_subcategory_info, subcategory.bg_subcategory_name, subcategory.bg_subcategory_info,
                            subcategory.ar_subcategory_name, subcategory.ar_subcategory_info,
                            subcategory.subcategory_date, subcategory.subcategory_user
                            FROM subcategory
                            LEFT JOIN category ON subcategory.category_id = category.id
                            INNER JOIN users ON subcategory.subcategory_user = users.id
                            WHERE subcategory.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                        $subCategoryRow = $subCategorySQL;

                        $category_one = "javascript:selectRadio('category_one')";
                        $category_two = "javascript:selectRadio('category_two')";

                        echo '
                            <div id="turkceDil-Tab">TÜRKÇE</div>
                            <div id="englishDil-Tab">ENGLISH</div>
                            <div id="germanDil-Tab">GERMAN</div>
                            <div id="russianDil-Tab">RUSSIAN</div>
                            <div id="bulgarianDil-Tab">BULGARIAN</div>
                            <div id="arabianDil-Tab">ARABIAN</div>
                            <form action="#" method="post">
                            <div id="turkceDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Eklenecek Yer</p>
                                <p>
                                    <input type="radio" name="degisecek_yer" value="0" onclick="'.$category_one.'" checked="checked" /> Yeri değiştirme
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="degisecek_yer" value="1" onclick="'.$category_two.'" unchecked /> Kategoriye
                                    <div id="category_one" class="SubCategorySecenek" style="display: visible;">
                                    <i class="fa fa-eye"></i> &nbsp;';
                                    if($subCategoryRow['CID'] == $subCategoryRow['category_id']) { echo 'Kategori - '.$subCategoryRow['category_name']; }
                                    else { echo 'Ekli olduğu bölüm yok !'; }
                        echo '
                                    </div>
                                    <div id="category_two" class="SubCategorySecenek" style="display: none;">
                                    <select name="category_id">
                                            <option value="0">Lütfen Sayfa seçiniz</option>';
                        $categorySQL = $pdo->prepare("SELECT id, category_name FROM category");
                        $categorySQL->execute();
                        $categoryRecord = $categorySQL->fetchAll();
                        foreach($categoryRecord as $categoryRec) { echo '<option value="'.$categoryRec['id'].'">'.$categoryRec['category_name'].'</option>'; }
                        echo '
                                    </select>
                                    </div>
                                </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Adı</p>
                                <p><input type="text" name="subcategory_name" value="'.$subCategoryRow['subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori İçerik</p>
                                <p><textarea name="subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            <div id="englishDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>En. Kategori Adı</p>
                                <p><input type="text" name="en_subcategory_name" value="'.$subCategoryRow['en_subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>En. Kategori İçerik</p>
                                <p><textarea name="en_subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['en_subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                        <div id="germanDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>De. Kategori Adı</p>
                                <p><input type="text" name="de_subcategory_name" value="'.$subCategoryRow['de_subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>De. Kategori İçerik</p>
                                <p><textarea name="de_subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['de_subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                        <div id="russianDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ru. Kategori Adı</p>
                                <p><input type="text" name="ru_subcategory_name" value="'.$subCategoryRow['ru_subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ru. Kategori İçerik</p>
                                <p><textarea name="ru_subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['ru_subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                        <div id="bulgarianDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Bg. Kategori Adı</p>
                                <p><input type="text" name="bg_subcategory_name" value="'.$subCategoryRow['bg_subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Bg. Kategori İçerik</p>
                                <p><textarea name="bg_subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['bg_subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                        <div id="arabianDil-Box">
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ar. Kategori Adı</p>
                                <p><input type="text" name="ar_subcategory_name" value="'.$subCategoryRow['ar_subcategory_name'].'"></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ar. Kategori İçerik</p>
                                <p><textarea name="ar_subcategory_info" class="ckeditor" id="editor1">'.$subCategoryRow['ar_subcategory_info'].'</textarea></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                            <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                            </p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <p>Ekleme Tarihi</p><p>'.$subCategoryRow['subcategory_date'].'<input type="hidden" value="'.$id.'" /></p>
                            </div>
                            <div class="SubCategoryMainCenter-Line2">
                                <button name="subcategoryDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                            </div>
                            </div>
                            </form>';
                    } else { subCategoryChange($pdo); }
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