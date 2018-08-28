<?php
    function userEmailChange($pdo) {
        $id = $_GET['userView'];
        $email_now = $_POST['email_now'];
        $email = $_POST['email'];
        $email2 = $_POST['email2'];

        $emailSQL = $pdo->query("SELECT email FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
        $emailGoster = $emailSQL;

        try {
            if($email_now == $emailGoster['email']) {
                if($email == $email2) {
                    $userEmailSQL = $pdo->prepare("UPDATE users SET email = '$email' WHERE id = '$id'");
                    $userEmailSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>E-Mail Adresi</b> başarıyla değiştirildi !</div>';
                    header("Refresh:2; url=user-view.php?userView=$id");
                } else {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/><b>E-Mail Adresleri</b> eşleşmedi. Lütfen kontrol ediniz !</div>';
                    header("Refresh:2; url=user-email-change.php?userView=$id");
                }
            } else {
                echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Şuanki <b>E-Mail Adresi</b> yanlıştır. Lütfen kontrol ediniz !</div>';
                header("Refresh:2; url=user-email-change.php?userView=$id");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>