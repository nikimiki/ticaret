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
        <link rel="stylesheet" type="text/css" href="css/subpage.css">
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
                    $id = $_GET['subPageView'];
                    $subpageSQL = $pdo->query("SELECT
                    subpage.id as SubPID, subpage.page_id, subpage.subpage_name, subpage.subpage_info,
                    subpage.en_subpage_name, subpage.en_subpage_info,
                    subpage.de_subpage_name, subpage.de_subpage_info,
                    subpage.ru_subpage_name, subpage.ru_subpage_info,
                    subpage.bg_subpage_name, subpage.bg_subpage_info,
                    subpage.ar_subpage_name, subpage.ar_subpage_info,
                    subpage.subpage_user, subpage.subpage_date,
                    page.id as PID, page.page_name,
                    users.id as UID, users.user_name
                    FROM subpage
                    LEFT JOIN page ON page.id = subpage.page_id
                    INNER JOIN users ON users.id = subpage.subpage_user
                    WHERE subpage.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $subpageRow = $subpageSQL;
                ?>
                <div class="SubPageMainHeader">
                    <p>ALT SAYFALAR - <?php echo $subpageRow['subpage_name']; ?><a href="subpages.php"><i class="fa fa-reply"></i></a></p>
                </div>
                <div class="SubPageMainCenter2">
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>Sayfa Adı</p><p>
                                <?php
                                    if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['subpage_name']; }
                                    else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['subpage_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>EN Sayfa Adı</p><p>
                                <?php
                                if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['en_subpage_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>EN Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['en_subpage_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>DE Sayfa Adı</p><p>
                                <?php
                                if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['de_subpage_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>DE Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['de_subpage_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>RU Sayfa Adı</p><p>
                                <?php
                                if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['ru_subpage_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>RU Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['ru_subpage_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>BG Sayfa Adı</p><p>
                                <?php
                                if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['bg_subpage_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>BG Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['bg_subpage_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box">
                        <div class="SubPageMainCenter-Line2">
                            <p>AR Sayfa Adı</p><p>
                                <?php
                                if($subpageRow['PID'] == $subpageRow['page_id']) { echo $subpageRow['ar_subpage_name']; }
                                else { echo 'Ekli olduğu yer bulunamadı !'; }
                                ?>
                            </p>
                        </div>
                        <div class="SubPageMainCenter-Line2">
                            <p>AR Sayfa İçerik</p>
                            <p><?php echo strip_tags($subpageRow['ar_subpage_info']); ?></p>
                        </div>
                    </div>
                    <div class="SubPageMainCenter-Line2">
                        <p>Sayfa Ekleme</p><p><?php echo $subpageRow['user_name']; ?></p>
                    </div>
                    <div class="SubPageMainCenter-Line2">
                        <p>Ekleme Tarihi</p><p><?php echo $subpageRow['subpage_date']; ?></p>
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