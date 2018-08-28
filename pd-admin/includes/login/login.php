<?php
    function loginSite($pdo) {
        try {
            session_start();
            ob_start();
            $user_name = $_POST['user_name'];
            $pass = $_POST['pass'];

            $loginSQL = $pdo->prepare("SELECT * FROM users WHERE user_name = :user_name && pass = md5(:pass) && kayit_tur != 4");
            $loginSQL->bindValue(':user_name', $user_name, PDO::PARAM_INT);
            $loginSQL->bindValue(':pass', $pass, PDO::PARAM_INT);
            $loginSQL->execute();

            $log = $loginSQL->fetchAll();

            if($loginSQL->rowCount() > 0){
                header('Location: main.php');

                $_SESSION['officer'] = $user_name;
                $_SESSION['id'] = $log[0]['id'];
            } else {
                echo '<div class="FormArea2"><p><i class="fa fa-exclamation-circle"></i>Kullanıcı Adı veya Şifre yanlış !</p></div>';
                header('Refresh:2; url=index.php');
            }

        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
        Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }

?>