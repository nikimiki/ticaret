<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/view/SliderCleanView.php');
    include('includes/clean/SliderClean.php');

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
        <script type="text/javascript">
            function confirmDelete() {
                var checkBox = confirm("Sayfaların silinmesini onaylıyormusunuz ?");
                if(checkBox == true) { return true; }
                else { window.alert("Sayfa silme işlemi iptal edildi !"); return false; }
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
                    <p><i class="fa fa-compass"></i>SLIDER | SİL</p>
                </div>
                <?php SliderCleanView($pdo); ?>
            </div>
            <div class="SectionRight">
                <?php PartRight($pdo); ?>
            </div>
        </section>
    </div>

    </body>
    </html>
<?php ob_end_flush(); ?>