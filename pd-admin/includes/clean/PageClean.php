<?php
    function pageClean($pdo) {
        if(isset($_POST['pageSil'])) {
            if(isset($_POST['pageClean'])) {
                $clean_id = $_POST['pageClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $PID) {
                        $pageSQL = $pdo->prepare("DELETE FROM page WHERE id = '$PID'");
                        $pageSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Sayfalar</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=page-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Sayfa</b> seçiniz !</div>";
                header('Refresh:2; url=page-clean.php');
            }
        } else {
            header('Refresh:0; url=page-clean.php');
        }
    }
?>