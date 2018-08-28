<?php
    include('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/add/SliderAdd.php');

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
                <div class="SliderMainHeader">
                    <p><a href="slider.php"><i class="fa fa-reply"></i></a>SLIDER</p>
                </div>
                <div class="SliderMainCenter2">
                    <?php
                    if (!isset($_POST['sliderGonder'])) {
                        echo '
                        <div id="turkceDil-Tab">TÜRKÇE</div>
                        <div id="englishDil-Tab">ENGLISH</div>
                        <div id="germanDil-Tab">GERMAN</div>
                        <div id="russianDil-Tab">RUSSIAN</div>
                        <div id="bulgarianDil-Tab">BULGARIAN</div>
                        <div id="arabianDil-Tab">ARABIAN</div>
                        <form action="#" method="post" enctype="multipart/form-data">
                        <div id="turkceDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Adı</p>
                            <p><input type="text" name="slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider İçerik</p>
                            <p><textarea name="slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Resmi</p>
                            <p><input type="file" name="slider_picture" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                            $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                            echo $oturum['user_name'];
                            echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="englishDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>En. Slider Adı</p>
                            <p><input type="text" name="en_slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>En. Slider İçerik</p>
                            <p><textarea name="en_slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="germanDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>De. Slider Adı</p>
                            <p><input type="text" name="de_slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>De. Slider İçerik</p>
                            <p><textarea name="de_slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="russianDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>Ru. Slider Adı</p>
                            <p><input type="text" name="ru_slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ru. Slider İçerik</p>
                            <p><textarea name="ru_slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="bulgarianDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>Bg. Slider Adı</p>
                            <p><input type="text" name="bg_slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Bg. Slider İçerik</p>
                            <p><textarea name="bg_slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        <div id="arabianDil-Box">
                        <div class="SliderMainCenter-Line2">
                            <p>Ar. Slider Adı</p>
                            <p><input type="text" name="ar_slider_name" /></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ar. Slider İçerik</p>
                            <p><textarea name="ar_slider_info" class="ckeditor" id="editor1"></textarea></p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Slider Ekleme</p><p style="color: #F0310C;"><i class="fa fa-user" style="margin-right: 10px;"></i>';
                        $oturum = $pdo->query('SELECT * FROM users WHERE user_name = "'.$_SESSION['officer'].'"')->fetch(PDO::FETCH_ASSOC);
                        echo $oturum['user_name'];
                        echo '
                        <input type="hidden" name="slider_user" value="'.$oturum['id'].'"/>
                        </p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <p>Ekleme Tarihi</p><p>';echo date("d.m.Y");echo '</p>
                        </div>
                        <div class="SliderMainCenter-Line2">
                            <button name="sliderGonder"><i class="fa fa-check-circle"></i>EKLE</button>
                        </div>
                        </div>
                        </form>
                        ';
                    }
                    else { sliderAdd($pdo); }
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