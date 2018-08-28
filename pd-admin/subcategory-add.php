<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/SubCategoryAdd.php');

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
                    <p><a href="categorys.php"><i class="fa fa-reply"></i></a>ALT KATEGORİLER</p>
                </div>
                <div class="SubCategoryMainCenter2">
                    <?php
                    if(!isset($_POST['subcategoryGonder'])) {
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
                                    <select name="category_id">
                                    <option value="0">Lütfen Kategori seçiniz</option>';
                                    $categorySql = $pdo->prepare("SELECT id, category_name FROM category");
                                    $categorySql->execute();
                                    $categoryRecords = $categorySql->fetchAll();
                                    foreach($categoryRecords as $category){
                                        echo '<option value="'.$category['id'].'">'.$category['category_name'].'</option>';
                                    }
                                echo '</select>
                                    </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Adı</p>
                                    <p><input type="text" name="subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori İçerik</p>
                                    <p><textarea name="subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                <div id="englishDil-Box">
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>En. Alt Kategori Adı</p>
                                    <p><input type="text" name="en_subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>En. Alt Kategori İçerik</p>
                                    <p><textarea name="en_subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                 <div id="germanDil-Box">
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>De. Alt Kategori Adı</p>
                                    <p><input type="text" name="de_subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>De. Alt Kategori İçerik</p>
                                    <p><textarea name="de_subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                 <div id="russianDil-Box">
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ru. Alt Kategori Adı</p>
                                    <p><input type="text" name="ru_subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ru. Alt Kategori İçerik</p>
                                    <p><textarea name="ru_subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                 <div id="bulgarianDil-Box">
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Bg. Alt Kategori Adı</p>
                                    <p><input type="text" name="bg_subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Bg. Alt Kategori İçerik</p>
                                    <p><textarea name="bg_subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                 <div id="arabianDil-Box">
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ar. Alt Kategori Adı</p>
                                    <p><input type="text" name="ar_subcategory_name" /></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ar. Alt Kategori İçerik</p>
                                    <p><textarea name="ar_subcategory_info" class="ckeditor" id="editor1"></textarea></p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Alt Kategori Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                                <input type="hidden" name="subcategory_user" value="'.$oturum['id'].'"/>
                                </p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'; echo date('d.m.Y'); echo '</p>
                                </div>
                                <div class="SubCategoryMainCenter-Line2">
                                    <button name="subcategoryGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                                </div>
                                </div>
                                </form>';
                    } else { subcategoryAdd($pdo); }
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