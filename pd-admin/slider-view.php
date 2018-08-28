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
        <link rel="stylesheet" type="text/css" href="css/slider.css">
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
                    $id = $_GET['sliderView'];
                    $sliderSQL = $pdo->query("SELECT
                    slider.id, slider.slider_name, slider.slider_info,
                    slider.en_slider_name, slider.en_slider_info, slider.de_slider_name, slider.de_slider_info,
                    slider.ru_slider_name, slider.ru_slider_info, slider.bg_slider_name, slider.bg_slider_info,
                    slider.ar_slider_name, slider.ar_slider_info,
                    slider.slider_picture, slider.slider_user, slider.slider_date, users.id, users.user_name
                    FROM slider
                    INNER JOIN users ON users.id = slider.slider_user
                    WHERE slider.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $sliderRow = $sliderSQL;
                ?>
                <div class="SliderMainHeader">
                    <p>SLIDER - <?php echo $sliderRow['slider_name']; ?><a href="slider.php"><i class="fa fa-reply"></i></a></p>
                </div>
                <div class="SliderMainCenter2">
                    <img src="pic/<?php echo $sliderRow['slider_picture']; ?>" alt="<?php echo $sliderRow['slider_name']; ?> - Resim" />
                    <div id="turkceDil-Tab">TÜRKÇE</div>
                    <div id="englishDil-Tab">ENGLISH</div>
                    <div id="germanDil-Tab">GERMAN</div>
                    <div id="russianDil-Tab">RUSSIAN</div>
                    <div id="bulgarianDil-Tab">BULGARIAN</div>
                    <div id="arabianDil-Tab">ARABIAN</div>
                    <div id="turkceDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Adı</p><p><?php echo $sliderRow['slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['slider_info']); ?></p>
                        </div>
                    </div>
                    <div id="englishDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>EN Slider Adı</p><p><?php echo $sliderRow['en_slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>EN Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['en_slider_info']); ?></p>
                        </div>
                    </div>
                    <div id="germanDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>DE Slider Adı</p><p><?php echo $sliderRow['de_slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>DE Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['de_slider_info']); ?></p>
                        </div>
                    </div>
                    <div id="russianDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>RU Slider Adı</p><p><?php echo $sliderRow['ru_slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>RU Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['ru_slider_info']); ?></p>
                        </div>
                    </div>
                    <div id="bulgarianDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>BG Slider Adı</p><p><?php echo $sliderRow['bg_slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>BG Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['bg_slider_info']); ?></p>
                        </div>
                    </div>
                    <div id="arabianDil-Box" style="min-height: 400px;">
                        <div class="SliderMainCenter-Line2">
                            <p>AR Slider Adı</p><p><?php echo $sliderRow['ar_slider_name']; ?></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>AR Slider İçerik</p>
                            <p><?php echo strip_tags($sliderRow['ar_slider_info']); ?></p>
                        </div>
                    </div>
                    <div class="SliderMainCenter-Line2">
                        <p>Slider Ekleme</p><p><?php echo $sliderRow['user_name']; ?></p>
                    </div>
                    <div class="SliderMainCenter-Line2">
                        <p>Ekleme Tarihi</p><p><?php echo $sliderRow['slider_date']; ?></p>
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