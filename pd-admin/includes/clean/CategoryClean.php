<?php
    function categoryClean($pdo) {
        if(isset($_POST['categorySil'])) {
            if(isset($_POST['categoryClean'])) {
                $clean_id = $_POST['categoryClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $CID) {
                        $categorySQL = $pdo->prepare("DELETE FROM category WHERE id = '$CID'");
                        $categorySQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Kategoriler</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=category-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Kategori</b> seçiniz !</div>";
                header('Refresh:2; url=category-clean.php');
            }
        } else {
            header("Refresh:0; url=category-clean.php");
        }
    }
?>