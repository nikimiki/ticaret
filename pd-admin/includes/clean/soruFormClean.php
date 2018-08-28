<?php
    function soruFormClean($pdo) {
        if(isset($_POST['soruSil'])) {
            try {
                if (isset($_POST['soruClean'])) {
                    $clean_id = $_POST['soruClean'];
                    $id = count($clean_id);

                    if (count($id) > 0) {
                        foreach ($clean_id as $CID) {
                            $soruSQL = $pdo->prepare("DELETE FROM soruform WHERE id = '$CID'");
                            $soruSQL->execute();
                        }
                        echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Soru Formu</b> başarıyla silinmiştir !</div>";
                        header('Refresh:2; url=soruform-clean.php');
                    }
                } else {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Soru Formu</b> seçiniz !</div>";
                    header('Refresh:2; url=soruform-clean.php');
                }
            } catch(PDOException $error) {

            }
        } else {
            header('Refresh:0; url=soruform-clean.php');
        }
    }
?>