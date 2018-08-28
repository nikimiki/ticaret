<?php
    function commentOnayIptal($pdo) {
        $id = $_GET['commentView'];
        $comment_onay = $_POST['comment_onay'];
        $onayVer = $_POST['onayVer'];
        $onayIptal = $_POST['onayIptal'];

        try {
            if($onayVer == 2) {
                $commentOnay = $pdo->prepare("UPDATE comment SET comment_onay = '2' WHERE id = '$id'");
                $commentOnay->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, Yorum\'a <b>Onay Verildi</b> !</div>';
                header("Refresh:2; url=comment-view.php?commentView=$id");
            }
            elseif($onayIptal == 1) {
                $commentOnay = $pdo->prepare("UPDATE comment SET comment_onay = '1' WHERE id = '$id'");
                $commentOnay->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, Yorum\'a <b>Onay Verilmedi</b> !</div>';
                header("Refresh:2; url=comment-view.php?commentView=$id");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>