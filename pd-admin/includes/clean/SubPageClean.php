<?php
    function subpageClean($pdo) {
        if(isset($_POST['subpageSil'])) {
            if(isset($_POST['subpageClean'])) {
                $clean_id = $_POST['subpageClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $PID) {
                        $pageSQL = $pdo->prepare("DELETE FROM subpage WHERE id = '$PID'");
                        $pageSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Alt Sayfalar</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=subpage-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Alt Sayfa</b> seçiniz !</div>";
                header('Refresh:2; url=subpage-clean.php');
            }
        } else {
            header('Refresh:0; url=subpage-clean.php');
        }
    }
?>