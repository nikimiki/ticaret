<?php
    function userChange($pdo) {
        $id = $_GET['userChange'];
        $ad = $_POST['ad'];
        $soyad = $_POST['soyad'];
        $cinsiyet = $_POST['cinsiyet'];
        $gun = $_POST['gun'];
        $ay = $_POST['ay'];
        $yil = $_POST['yil'];
        $dtarih = $gun.'.'.$ay.'.'.$yil;
        $ogrenim = $_POST['ogrenim'];
        $kayit_tur = $_POST['kayit_tur'];

        $cinsiyet_degis = $_POST['cinsiyet_degis'];
        $dtarih_degis = $_POST['dtarih_degis'];
        $ogrenim_degis = $_POST['ogrenim_degis'];
        $kayit_degis = $_POST['kayit_degis'];

        try {
            if(($cinsiyet_degis == 0) && ($dtarih_degis == 0) && ($ogrenim_degis == 0) && ($kayit_degis == 0)) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değişmeyenler: <br/>
                      <i class="fa fa-ban" style="font-size: 15px;"></i> Cinsiyet, Doğum Tarihi, Öğrenim Durumu, Kayıt Türü<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
            elseif(($cinsiyet_degis == 1) && ($dtarih_degis == 1) && ($ogrenim_degis == 1) && ($kayit_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', dtarih = '$dtarih', ogrenim = '$ogrenim', kayit_tur = '$kayit_tur'
                    WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet, Doğum Tarihi, Öğrenim Durumu ve Kayıt Türü<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($cinsiyet_degis == 1) && ($dtarih_degis == 1) && ($ogrenim_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', dtarih = '$dtarih', ogrenim = '$ogrenim'
                    WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet, Doğum Tarihi ve Öğrenim Durumu<br/>
                      </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($dtarih_degis == 1) && ($ogrenim_degis == 1) && ($kayit_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', dtarih = '$dtarih', ogrenim = '$ogrenim', kayit_tur = '$kayit_tur'
                    WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Doğum Tarihi, Öğrenim Durumu ve Kayıt Türü<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($cinsiyet_degis == 1) && ($ogrenim_degis == 1) && ($kayit_degis == 1)) {
                if($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', ogrenim = '$ogrenim', kayit_tur = '$kayit_tur'
                    WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet, Öğrenim Durumu ve Kayıt Türü<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($cinsiyet_degis == 1) && ($dtarih_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', dtarih = '$dtarih' WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet ve Doğum Tarihi<br/>
                      </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($ogrenim_degis == 1) && ($kayit_degis == 1)) {
                if($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', ogrenim = '$ogrenim', kayit_tur = '$kayit_tur' WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Öğrenim Durumu ve Kayıt Türü<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }

            elseif(($dtarih_degis == 1) && ($kayit_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', dtarih = '$dtarih', kayit_tur = '$kayit_tur'
                    WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Doğum Tarihi ve Kayıt Türü<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($cinsiyet_degis == 1) && ($ogrenim_degis == 1)) {
                if($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', ogrenim = '$ogrenim' WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet ve Öğrenim Durumu<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($dtarih_degis == 1) && ($ogrenim_degis == 1)) {
                if($gun == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Gün</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ay == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Ay</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($yil == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, doğum tarihinde <b>Yıl</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } elseif($ogrenim == 0) {
                    echo '<div class="DbOk"><i class="fa fa-frown-o"></i><br/>Lütfen, <b>Öğrenim Durumu</b> seçiniz !</div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                } else {
                    $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', dtarih = '$dtarih', ogrenim = '$ogrenim' WHERE id = '$id'");
                    $userSQL->execute();
                    echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                         Değiştirilenler: <br/>
                         <i class="fa fa-check" style="font-size: 15px;"></i> Doğum Tarihi ve Öğrenim Durumu<br/>
                         </div>';
                    header("Refresh:2; url=user-changed.php?userChange=$id");
                }
            }
            elseif(($cinsiyet_degis == 1) && ($kayit_degis == 1)) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet', kayit_tur = '$kayit_tur' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet ve Kayıt Türü<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
            elseif($cinsiyet_degis == 1) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', cinsiyet = '$cinsiyet' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Cinsiyet<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
            elseif($dtarih_degis == 1) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', dtarih = '$dtarih' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Doğum Tarihi<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
            elseif($ogrenim == 1) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', ogrenim = '$ogrenim' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Öğrenim Durumu<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
            elseif($kayit_degis == 1) {
                $userSQL = $pdo->prepare("UPDATE users SET ad = '$ad', soyad = '$soyad', kayit_tur = '$kayit_tur' WHERE id = '$id'");
                $userSQL->execute();
                echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>Üye Bilgisi</b> başarıyla değiştirildi.<br/><br/>
                      Değiştirilenler: <br/>
                      <i class="fa fa-check" style="font-size: 15px;"></i> Kayıt Türü<br/>
                      </div>';
                header("Refresh:2; url=user-changed.php?userChange=$id");
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>