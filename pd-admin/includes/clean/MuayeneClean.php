<?php
    function muayeneClean($pdo) {
        if(isset($_POST['muayeneSil'])) {
            try {
                if (isset($_POST['muayeneClean'])) {
                    $clean_id = $_POST['muayeneClean'];
                    $id = count($clean_id);

                    if (count($id) > 0) {
                        foreach ($clean_id as $CID) {
                            $muayeneSQL = $pdo->prepare("DELETE FROM muayene WHERE id = '$CID'");
                            $muayeneSQL->execute();
                        }
                        echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Muayene Talebi</b> başarıyla silinmiştir !</div>";
                        header('Refresh:2; url=muayene-clean.php');
                    }
                } else {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Muayene Talebi</b> seçiniz !</div>";
                    header('Refresh:2; url=muayene-clean.php');
                }
            } catch(PDOException $error) {

            }
        } else {
            header('Refresh:0; url=muayene-clean.php');
        }
    }
?>