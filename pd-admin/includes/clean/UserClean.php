<?php
    function userClean($pdo) {
        if(isset($_POST['userSil'])) {
            if(isset($_POST['userClean'])) {
                $clean_id = $_POST['userClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $UID) {
                        $userSQL = $pdo->prepare("DELETE FROM users WHERE id = '$UID'");
                        $userSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Üyeler</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=user-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Üye</b> seçiniz !</div>";
                header('Refresh:2; url=user-clean.php');
            }
        } else {
            header("Refresh:0; url=user-clean.php");
        }
    }
?>