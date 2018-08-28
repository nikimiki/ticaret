<?php
    function passReset($pdo) {
        $email = $_POST['email'];

        try {
            if(empty($_POST['email'])) {
                echo '<div class="FormArea2"><p><i class="fa fa-exclamation-circle"></i>Lütfen bir e-mail adresi yazınız !</p></div>';
                header('Refresh:2; url=password-reset.php');
            } else {
                $passSQL = $pdo->prepare("SELECT email FROM users WHERE email = :email");
                $passSQL->bindParam(':email', $email);
                $passSQL->execute();

                if($passSQL->rowCount() > 0) {
                    $geciciSifre = rand(23175, 23091);
                    $new_password = $geciciSifre;
                    $new_password = md5($new_password);

                    $passDegistir = $pdo->query("UPDATE users SET pass = '$new_password' WHERE email = '$email'");
                    $passDegistir->execute();

                    $subject = "Giriş bilgileriniz";
                    $message = "Yeni şifren: $new_password";
                    $from = "From: example@example.com";

                    mail($email, $subject, $message, $from);
                    echo '<div class="FormArea2"><p><i class="fa fa-key"></i>Yeni şifreniz e-mail adresinizi gönderildi !</p></div>';
                    header('Refresh:2; url=index.php');
                }
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>