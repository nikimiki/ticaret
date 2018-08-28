<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/SliderChange.php');

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
        <script type="text/javascript">
            function sliderRadio(i) {
                document.getElementById('slider_one').style.display = "none";
                document.getElementById('slider_two').style.display = "none";
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
                <div class="SliderMainHeader">
                    <p><a href="slider-change.php"><i class="fa fa-reply"></i></a>SLIDER | DEĞİŞTİR</p>
                </div>
                <div class="SliderMainCenter2">
                    <?php
                    if(!isset($_POST['sliderDegistir'])) {
                        $id = $_GET['sliderChange'];

                        $slider_one = "javascript:sliderRadio('slider_one')";
                        $slider_two = "javascript:sliderRadio('slider_two')";

                        $sliderSQL = $pdo->query("SELECT
                        slider.id as SID, slider.slider_name, slider.slider_info,
                        slider.en_slider_name, slider.en_slider_info,
                        slider.de_slider_name, slider.de_slider_info,
                        slider.ru_slider_name, slider.ru_slider_info,
                        slider.bg_slider_name, slider.bg_slider_info,
                        slider.ar_slider_name, slider.ar_slider_info,
                        slider.slider_picture, slider.slider_user, slider.slider_date,
                        users.id as UID, users.user_name
                        FROM slider
                        INNER JOIN users ON slider.slider_user = users.id
                        WHERE slider.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                        $sliderRow = $sliderSQL;
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
                                        <p><input type="text" name="slider_name" value="'.$sliderRow['slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>Slider İçerik</p>
                                        <p><textarea name="slider_info" class="ckeditor" id="editor1">'.$sliderRow['slider_info'].'</textarea></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>Slider Resim</p>
                                        <p>
                                            <input type="radio" name="resim_degis" value="0" onclick="'.$slider_one.'" checked="checked" /> Resim değiştirme
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="resim_degis" value="1" onclick="'.$slider_two.'" unchecked /> Resim değiştir

                                            <div id="slider_one" class="SliderSecenek" style="display: visible;">
                                                Şuanki Resim:<br/><br/>
                                                <img src="pic/'.$sliderRow['slider_picture'].'" alt="'.$sliderRow['slider_name'].' - Resmi" style="width:100px;height:70px;" />
                                            </div>
                                            <div id="slider_two" class="SliderSecenek" style="display: none;">
                                                <input type="file" name="slider_picture" id="slider_picture"/>
                                            </div>
                                        </p>
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
                                        <p>Ekleme Tarihi</p><p>'.$sliderRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="englishDil-Box">
                                    <div class="SliderMainCenter-Line2">
                                        <p>En. Slider Adı</p>
                                        <p><input type="text" name="en_slider_name" value="'.$sliderRow['en_slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>En. Slider İçerik</p>
                                        <p><textarea name="en_slider_info" class="ckeditor" id="editor1">'.$sliderRow['en_slider_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="germanDil-Box">
                                    <div class="SliderMainCenter-Line2">
                                        <p>De. Slider Adı</p>
                                        <p><input type="text" name="de_slider_name" value="'.$sliderRow['de_slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>De. Slider İçerik</p>
                                        <p><textarea name="de_slider_info" class="ckeditor" id="editor1">'.$sliderRow['de_slider_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="russianDil-Box">
                                    <div class="SliderMainCenter-Line2">
                                        <p>Ru. Slider Adı</p>
                                        <p><input type="text" name="ru_slider_name" value="'.$sliderRow['ru_slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>Ru. Slider İçerik</p>
                                        <p><textarea name="ru_slider_info" class="ckeditor" id="editor1">'.$sliderRow['ru_slider_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="bulgarianDil-Box">
                                    <div class="SliderMainCenter-Line2">
                                        <p>Bg. Slider Adı</p>
                                        <p><input type="text" name="bg_slider_name" value="'.$sliderRow['bg_slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>Bg. Slider İçerik</p>
                                        <p><textarea name="bg_slider_info" class="ckeditor" id="editor1">'.$sliderRow['bg_slider_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    <div id="arabianDil-Box">
                                    <div class="SliderMainCenter-Line2">
                                        <p>Ar. Slider Adı</p>
                                        <p><input type="text" name="ar_slider_name" value="'.$sliderRow['ar_slider_name'].'"/></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <p>Ar. Slider İçerik</p>
                                        <p><textarea name="ar_slider_info" class="ckeditor" id="editor1">'.$sliderRow['ar_slider_info'].'</textarea></p>
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
                                        <p>Ekleme Tarihi</p><p>'.$pageRow['slider_date'].'<input type="hidden" value="'.$id.'" /></p>
                                    </div>
                                    <div class="SliderMainCenter-Line2">
                                        <button name="sliderDegistir"><i class="fa fa-exchange" style="margin-left: 16px;"></i>DEĞİŞTİR</button>
                                    </div>
                                    </div>
                                    </form>
                        ';
                    } else { sliderChange($pdo); }
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