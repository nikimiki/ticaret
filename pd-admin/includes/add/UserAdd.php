<?php
    function userAdd($pdo) {
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $cinsiyet = $_POST['cinsiyet'];
        $gun = $_POST['gun'];
        $ay = $_POST['ay'];
        $yil = $_POST['yil'];
        $dtarih = $gun.'.'.$ay.'.'.$yil;
        $ogrenim = $_POST['ogrenim'];
        $user_name = $_POST['user_name'];
        $pass = $_POST['pass'];
        $passMD = md5($pass);
        $pass2 = $_POST['pass2'];
        $passMD2 = md5($pass2);
        $email = $_POST['email'];
        $kayit_tur = $_POST['kayit_tur'];
        $user_date = date("d.m.Y");

        try {
            if($ad == "") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Ad</b> ınızı boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($soyad == "") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Soyad</b> ınızı boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($user_name == "") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Kullanıcı Adı</b> nızı boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($pass == "") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Şifre</b> nizi boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($email == "") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>E-Mail</b> nizi boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($ogrenim == "0") {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>ŞLütfen <b>Ögrenim Durum</b> unu boş bırakmayınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif($passMD !== $passMD2) {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Şifreler eşleşmiyor, lütfen kontrol ederek tekrar yazınız !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif(strlen($user_name) < 6 || strlen($user_name) > 20) {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Kullanıcı Adı <b>en az 6, en çok 20</b> karakter olabilir !</div>";
                header('Refresh:2; url=user-add.php');
            } elseif(strlen($pass) < 6 || strlen($pass) > 20) {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Şifre <b>en az 6, en çok 20</b> karakter olabilir !</div>";
                header('Refresh:2; url=user-add.php');
            } else {

                //Kullanıcı Adı Kontrolü
                $userKontrol = $pdo->prepare("SELECT user_name FROM users WHERE user_name = :user_name ");
                $userKontrol->bindParam(':user_name', $user_name);
                $userKontrol->execute();

                //E-Mail Adresi Kontrolü
                $emailKontrol = $pdo->prepare("SELECT email FROM users WHERE email = :email");
                $emailKontrol->bindParam(':email', $email);
                $emailKontrol->execute();

                if($userKontrol->rowCount() > 0) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen başka bir <b>Kullanıcı Adı</b>
                                    yazınız ! Yazdığınız <b>Kullanıcı Adı</b> kullanılmaktadır.</div>";
                    header('Refresh:2; url=user-add.php');
                } elseif($emailKontrol->rowCount() > 0) {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen başka bir <b>E-Mail Adresi</b>
                                    yazınız ! Yazdığınız <b>E-Mail Adresi</b> kullanılmaktadır.</div>";
                    header('Refresh:2; url=user-add.php');
                } else {
                    $userKayit = $pdo->prepare("INSERT INTO users (ad, soyad, cinsiyet, dtarih, ogrenim, user_name, pass, email, kayit_tur, user_date)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $userKayit->execute(array($ad, $soyad, $cinsiyet, $dtarih, $ogrenim, $user_name, $passMD, $email, $kayit_tur, $user_date));

                    header('Refresh:2; url=users.php');
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler <b>Üye Kaydı</b> başarıyla yapılmıştır !</div>";
                }
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
            header('Refresh:2; url=user-add.php');
        }
    }
?>