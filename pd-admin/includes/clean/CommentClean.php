<?php
    function commentClean($pdo) {
        if(isset($_POST['commentSil'])) {
            if(isset($_POST['commentClean'])) {
                $clean_id = $_POST['commentClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $CID) {
                        $commentSQL = $pdo->prepare("DELETE FROM comment WHERE id = '$CID'");
                        $commentSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yorumlar</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=comment-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 yorum</b> seçiniz !</div>";
                header('Refresh:2; url=comment-clean.php');
            }
        } else {
            header("Refresh:0; url=comment-clean.php");
        }
    }
?>