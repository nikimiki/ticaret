<?php
    function contactAdd($pdo) {
        $phone = $_POST['phone'];
        $phone2 = $_POST['phone2'];
        $phone3 = $_POST['phone3'];
        $fax = $_POST['fax'];
        $fax2 = $_POST['fax2'];
        $fax3 = $_POST['fax3'];
        $email = $_POST['email3'];
        $email2 = $_POST['email2'];
        $email3 = $_POST['email3'];
        $adres = $_POST['adres'];
        $adres2 = $_POST['adres2'];
        $adres3 = $_POST['adres3'];
        $contact_user = $_POST['contact_user'];
        $contact_date = date("d.m.Y");

        try {
            $contactSQL = $pdo->prepare("
            INSERT INTO contact (phone, phone2, phone3, fax, fax2, fax3, email, email2, email3, adres, adres2, adres3, contact_user, contact_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $contactSQL->execute(array($phone, $phone2, $phone3, $fax, $fax2, $fax3, $email, $email2, $email3, $adres, $adres2, $adres3,
            $contact_user, $contact_date));

            header('Refresh:2, url=contacts.php');
            echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>İletişim Bilgileri</b> başarıyla eklenmiştir.</div>";
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>