<?php
    function emailClean($pdo) {
        if(isset($_POST['emailSil'])) {
            if(isset($_POST['emailClean'])) {
                $clean_id = $_POST['emailClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $EID) {
                        $emailSQL = $pdo->prepare("DELETE FROM email WHERE id = '$EID'");
                        $emailSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>E-Mail</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=e-mail-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 e-mail</b> seçiniz !</div>";
                header('Refresh:2; url=e-mail-clean.php');
            }
        } else {
            header("Refresh:0; url=e-mail-clean.php");
        }
    }
?>