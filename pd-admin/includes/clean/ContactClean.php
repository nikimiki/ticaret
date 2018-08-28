<?php
    function contactClean($pdo) {
        if(isset($_POST['contactSil'])) {
            if(isset($_POST['contactClean'])) {
                $clean_id = $_POST['contactClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $PID) {
                        $contactSQL = $pdo->prepare("DELETE FROM contact WHERE id = '$PID'");
                        $contactSQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>İletişim Bilgileri</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=contact-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 İletişim Bilgisi</b> seçiniz !</div>";
                header('Refresh:2; url=contact-clean.php');
            }
        } else {
            header('Refresh:0; url=contact-clean.php');
        }
    }
?>