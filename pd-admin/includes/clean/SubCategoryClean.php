<?php
    function subcategoryClean($pdo) {
        if(isset($_POST['subcategorySil'])) {
            if(isset($_POST['subcategoryClean'])) {
                $clean_id = $_POST['subcategoryClean'];
                $id = count($clean_id);

                if(count($id) > 0) {
                    foreach($clean_id as $CID) {
                        $categorySQL = $pdo->prepare("DELETE FROM subcategory WHERE id = '$CID'");
                        $categorySQL->execute();
                    }
                    echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Alt Kategoriler</b> başarıyla silinmiştir !</div>";
                    header('Refresh:2; url=subcategory-clean.php');
                }
            } else {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>en az 1 Alt Kategori</b> seçiniz !</div>";
                header('Refresh:2; url=subcategory-clean.php');
            }
        } else {
            header("Refresh:0; url=subcategory-clean.php");
        }
    }
?>