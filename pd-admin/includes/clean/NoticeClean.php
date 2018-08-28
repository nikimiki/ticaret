<?php
    function noticeClean($pdo) {
        if(isset($_POST['noticeSil'])) {
            if(isset($_POST['noticeClean'])) {
                $clean_id = $_POST['noticeClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $NID) {
                        $noticeSQL = $pdo->prepare("DELETE FROM notice WHERE id = '$NID'");
                        $noticeSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Duyurular</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=notice-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 duyuru</b> seçiniz !</div>";
                header('Refresh:2; url=notice-clean.php');
            }
        } else {
            header("Refresh:0; url=notice-clean.php");
        }
    }
?>