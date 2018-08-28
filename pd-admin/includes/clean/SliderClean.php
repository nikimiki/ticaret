<?php
    function sliderClean($pdo) {
        if(isset($_POST['sliderSil'])) {
            if(isset($_POST['sliderClean'])) {
                $clean_id = $_POST['sliderClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $SID) {
                        $sliderSQL = $pdo->prepare("DELETE FROM slider WHERE id = '$SID'");
                        $sliderSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Slider</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=slider-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Slider</b> seçiniz !</div>";
                header('Refresh:2; url=slider-clean.php');
            }
        } else {
            header('Refresh:0; url=slider-clean.php');
        }
    }
?>