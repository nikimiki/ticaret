<?php
    function videoAdd($pdo) {
        $article_id = $_POST['article_id'];
        $video_name = $_POST['video_name'];
        $video_info = $_POST['video_info'];
        $en_video_name = $_POST['en_video_name'];
        $en_video_info = $_POST['en_video_info'];
        $de_video_name = $_POST['de_video_name'];
        $de_video_info = $_POST['de_video_info'];
        $ru_video_name = $_POST['ru_video_name'];
        $ru_video_info = $_POST['ru_video_info'];
        $bg_video_name = $_POST['bg_video_name'];
        $bg_video_info = $_POST['bg_video_info'];
        $ar_video_name = $_POST['ar_video_name'];
        $ar_video_info = $_POST['ar_video_info'];
        $video_link = $_POST['video_link'];
        $video_user = $_POST['video_user'];
        $video_date = date("d.m.Y");

        try {
            if($video_name == '') {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Video Adını</b> boş bırakmayınız !</div>";
                header('Refresh:2; url=video-add.php');
            }
            elseif($video_info == '') {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Video İçeriğini</b> boş bırakmayınız !</div>";
                header('Refresh:2; url=video-add.php');
            }
            elseif($video_link == '') {
                echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>Lütfen <b>Video Linkini</b> boş bırakmayınız !</div>";
                header('Refresh:2; url=video-add.php');
            }
            else {
                $videoSQL = $pdo->prepare("
                INSERT INTO video (article_id, video_name, video_info, en_video_name, en_video_info, de_video_name, de_video_info,
                ru_video_name, ru_video_info, bg_video_name, bg_video_info, ar_video_name, ar_video_info,
                video_link, video, video_user, video_date)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $videoSQL->execute(array($article_id, $video_name, $video_info, $en_video_name, $en_video_info, $de_video_name, $de_video_info,
                    $ru_video_name, $ru_video_info, $bg_video_name, $bg_video_info, $ar_video_name, $ar_video_info,
                    $video_link, $video, $video_user, $video_date));

                header('Refresh:2, url=videos.php');
                echo "<div class='DbOk'><i class='fa fa-check-circle'></i><br/>Tebrikler, <b>Video</b> başarıyla eklenmiştir.</div>";
            }
        } catch(PDOException $error) {
            echo "<div class='DbOk'><i class='fa fa-frown-o'></i><br/>
            Beklenmedik bir hata oluştu, lütfen daha sonra tekrar deneyiniz.</div>" . $error->getMessage();
        }
    }
?>