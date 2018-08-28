<?php
    function analizClean($pdo) {
        if(isset($_POST['analizSil'])) {
            try {
                if (isset($_POST['analizClean'])) {
                    $clean_id = $_POST['analizClean'];
                    $id = count($clean_id);

                    if (count($id) > 0) {
                        foreach ($clean_id as $CID) {
                            $analizSQL = $pdo->prepare("DELETE FROM foto_muayene WHERE id = '$CID'");
                            $analizSQL->execute();
                        }
                        echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Fotoğraf Analiz</b> başarıyla silinmiştir !</div>";
                        header('Refresh:2; url=analiz-clean.php');
                    }
                } else {
                    echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Fotoğraf Analiz</b> seçiniz !</div>";
                    header('Refresh:2; url=analiz-clean.php');
                }
            } catch(PDOException $error) {

            }
        } else {
            header('Refresh:0; url=analiz-clean.php');
        }
    }
?>