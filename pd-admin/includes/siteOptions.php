<?php
    function siteOption($pdo) {
        if(isset($_POST['metaDegis'])) {
            $site_name = $_POST['site_name'];
            $meta_description = $_POST['meta_description'];
            $meta_keywords = $_POST['meta_keywords'];
            $meta_date = date('d.m.Y H:i:s');

            $metaUpdate = $pdo->prepare("UPDATE meta_tags SET
            site_name = '$site_name', meta_description = '$meta_description', meta_keywords = '$meta_keywords',
            meta_date = '$meta_date'");
            $metaUpdate->execute();

            echo '
                <script>
                alert("Site Bilgileri Başarıyla Değiştirildi !");
                location.href = "main.php";
                </script>
            ';
        } else {
            $metaSQL = $pdo->query("SELECT * FROM meta_tags")->fetch(PDO::FETCH_ASSOC);
            $meta = $metaSQL;
            $metaTotal = explode(',', $meta['meta_keywords']);
            echo '
                <form action="main.php" method="post" id="metaFormu">
                    <div class="siteAdi">Site Adı</div>
                    <div class="siteAdi2">
                        <input type="text" name="site_name" value="'.$meta['site_name'].'"/>
                    </div>
                    <div class="siteAdi">Site Açıklama</div>
                    <div class="siteAdi2">
                        <input type="text" name="meta_description" value="'.$meta['meta_description'].'"/>
                    </div>
                    <div class="siteAdi">Site Kelimeleri</div>
                    <div class="siteAdi2">
                        <textarea name="meta_keywords">'.$meta['meta_keywords'].'</textarea>
                    </div>
                    <div class="siteAdi"></div>
                    <div class="siteAdi2">
                        Toplam Kelime: <b>'.count($metaTotal).'</b>
                        <button name="metaDegis">DEĞİŞTİR</button>
                    </div>
                </form>
            ';
        }
    }
?>