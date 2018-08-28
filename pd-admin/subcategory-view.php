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
        <link rel="stylesheet" type="text/css" href="css/subcategory.css">
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
                    $id = $_GET['subcategoryView'];
                    $subcategorySQL = $pdo->query("SELECT
                    subcategory.id as SubCID, subcategory.category_id, subcategory.subcategory_name, subcategory.subcategory_info,
                    subcategory.en_subcategory_name, subcategory.en_subcategory_info,
                    subcategory.de_subcategory_name, subcategory.de_subcategory_info,
                    subcategory.ru_subcategory_name, subcategory.ru_subcategory_info,
                    subcategory.bg_subcategory_name, subcategory.bg_subcategory_info,
                    subcategory.ar_subcategory_name, subcategory.ar_subcategory_info,
                    subcategory.subcategory_user, subcategory.subcategory_date,
                    category.id as CID, category.category_name,
                    users.id as UID, users.user_name
                    FROM subcategory
                    LEFT JOIN category ON category.id = subcategory.category_id
                    INNER JOIN users ON users.id = subcategory.subcategory_user
                    WHERE subcategory.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $subcategoryRow = $subcategorySQL;
                ?>
                <div class="SubCategoryMainHeader">
                    <p>ALT KATEGORİLER - <?php echo $subcategoryRow['subcategory_name']; ?><a href="subcategorys.php"><i class="fa fa-reply"></i></a></p>
                </div>
                <div class="SubCategoryMainCenter2">
                    <div class="SubCategoryMainCenter-Line2">
                        <p>Kategori Adı</p><p>
                            <?php
                                if($subcategoryRow['CID'] == $subcategoryRow['category_id']) { echo $subcategoryRow['category_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                            ?>
                        </p>
                    </div>
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>Alt Kategori Adı</p><p><?php echo $subcategoryRow['subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>EN Alt Kategori Adı</p><p><?php echo $subcategoryRow['en_subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>EN Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['en_subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>DE Alt Kategori Adı</p><p><?php echo $subcategoryRow['de_subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>DE Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['de_subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>RU Alt Kategori Adı</p><p><?php echo $subcategoryRow['ru_subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>RU Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['ru_subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>BG Alt Kategori Adı</p><p><?php echo $subcategoryRow['bg_subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>BG Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['bg_subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="SubCategoryMainCenter-Line2">
                            <p>AR Alt Kategori Adı</p><p><?php echo $subcategoryRow['ar_subcategory_name']; ?></p>
                        </div>
                        <div class="SubCategoryMainCenter-Line2">
                            <p>AR Alt Kategori İçerik</p>
                            <p><?php echo strip_tags($subcategoryRow['ar_subcategory_info']); ?></p>
                        </div>
                    </div>
                    <div class="SubCategoryMainCenter-Line2">
                        <p>Alt Kategori Ekleme</p><p><?php echo $subcategoryRow['user_name']; ?></p>
                    </div>
                    <div class="SubCategoryMainCenter-Line2">
                        <p>Ekleme Tarihi</p><p><?php echo $subcategoryRow['subcategory_date']; ?></p>
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