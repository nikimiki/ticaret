<?php
    function userPassChange($pdo) {
        $id = $_GET['userView'];
        $pass_now = $_POST['pass_now'];
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        $passSQL = $pdo->query("SELECT pass FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
        $passGoster = $passSQL;

        try {
            if(md5($pass_now) == $passGoster['pass']) {
                if($pass == $pass2) {
                    if(strlen($pass) < 6 || strlen($pass) > 30) {
                        echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Şifre <b>en az 6, en çok 30</b> karakter olabilir !</div>";
                        header("Refresh:2; url=user-pass-change.php?userView=$id");
                    } else {
                        $userPassSQL = $pdo->prepare("UPDATE users SET pass = md5('$pass') WHERE id = '$id'");
                        $userPassSQL->execute();
                        echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Şifre</b> başarıyla değiştirildi !</div>';
                        header("Refresh:2; url=user-view.php?userView=$id");
                    }
                } else {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/><b>Şifreler</b> eşleşmedi. Lütfen kontrol ediniz !</div>';
                    header("Refresh:2; url=user-pass-change.php?userView=$id");
                }
            } else {
                echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Şuanki <b>Şifre</b> yanlıştır. Lütfen kontrol ediniz !</div>';
                header("Refresh:2; url=user-pass-change.php?userView=$id");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>