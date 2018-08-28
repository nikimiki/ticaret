<?php
    function articleClean($pdo) {
        if(isset($_POST['articleSil'])) {
            try {
                if (isset($_POST['articleClean'])) {
                    $clean_id = $_POST['articleClean'];
                    $id = count($clean_id);

                    if (count($id) > 0) {
                        foreach ($clean_id as $CID) {
                            $articleSQL = $pdo->prepare("DELETE FROM article WHERE id = '$CID'");
                            $articleSQL->execute();
                        }
                        echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Yazılar</b> başarıyla silinmiştir !</div>";
                        header('Refresh:2; url=article-clean.php');
                    }
                } else {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 yazı</b> seçiniz !</div>";
                    header('Refresh:2; url=article-clean.php');
                }
            } catch(PDOException $error) {

            }
        } else {
            header('Refresh:0; url=article-clean.php');
        }
    }
?>