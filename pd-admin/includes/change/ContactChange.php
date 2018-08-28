<?php
    function contactChange($pdo) {
        $id = $_GET['contactChange'];
        $phone = $_POST['phone'];
        $phone2 = $_POST['phone2'];
        $phone3 = $_POST['phone3'];
        $fax = $_POST['fax'];
        $fax2 = $_POST['fax2'];
        $fax3 = $_POST['fax3'];
        $email = $_POST['email'];
        $email2 = $_POST['email2'];
        $email3 = $_POST['email3'];
        $adres = $_POST['adres'];
        $adres2 = $_POST['adres2'];
        $adres3 = $_POST['adres3'];
        $contact_user = $_POST['contact_user'];
        $contact_date = date('d.m.Y');

        try {
            $contactSQL = $pdo->prepare("UPDATE contact SET
                phone = '$phone', phone2 = '$phone2', phone3 = '$phone3',
                fax = '$fax', fax2 = '$fax2', fax3 = '$fax3',
                email = '$email', email2 = '$email2', email3 = '$email3',
                adres = '$adres', adres2 = '$adres2', adres3 = '$adres3',
                contact_user = '$contact_user', contact_date = '$contact_date'
                WHERE id = '$id'");
            $contactSQL->execute();
            echo '<div class="DbOk"><i class="fa fa-check-circle"></i><br/>Tebrikler, <b>İletişim Bilgisi</b> başarıyla değiştirildi.</div>';
            header("Refresh:2; url=contact-change.php");
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
                Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>