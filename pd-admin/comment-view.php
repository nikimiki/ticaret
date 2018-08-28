<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/CommentOnayIptal.php');

    session_start();
    ob_start();

    if(!$_SESSION['officer']) { header('Location: index.php'); }
    $officer = $_SESSION['officer'];
    $officerID = $_SESSION['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administration Panel | Poema Design Creative Agency</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/comment.css">
	<link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/menu-collapsed.js"></script>
    <script type="text/javascript">
        function confirmDelete() {
            var checkBox = confirm("Yorum'a onay iptal işlemini onaylıyormusunuz ?");
            if(checkBox == true) { return true; }
            else { window.alert("Yorum onay iptal işlemi iptal edildi !"); return false; }
        }
        function confirmAgree() {
            var checkBox = confirm("Yorum'a onay verme işlemini onaylıyormusunuz ?");
            if(checkBox == true) { return true; }
            else { window.alert("Yorum'a onay verme işlemi iptal edildi !"); return false; }
        }
    </script>
</head>
<body>

	<div id="TotalTab">
		<header>
			<div class="HeaderLeft"></div>
			<div class="HeaderRight">
				<?php SearchPart(); ?>
                <?php HeaderOptions($pdo); ?>
			</div>
		</header>
		<section>
			<div class="SectionLeft">
				<?php PartLeft(); ?>
			</div>
			<div class="SectionConText">
                <?php
                    $id = $_GET['commentView'];
                    $commentSQL = $pdo->query("SELECT
                    comment.id as CommentID, comment.article_id, comment.comment, comment.ad_soyad, comment.email, comment.comment_onay, comment.comment_date,
                    article.id, article.article_name
                    FROM comment
                    LEFT JOIN article ON comment.article_id = article.id
                    WHERE comment.id = '$id'")->fetch(PDO::FETCH_ASSOC);
                    $commentRow = $commentSQL;
                ?>
				<div class="CommentMainHeader">
					<p>YORUMLAR - <?php echo $commentRow['article_name']; ?><a href="comments.php"><i class="fa fa-reply"></i></a></p>
				</div>
				<div class="CommentMainCenter2">
                    <?php
                        if(!isset($_POST['onayVer']) && !isset($_POST['onayIptal'])) {
                            echo '
                                <form action="#" method="post">
                                <div class="CommentOnayLine">
                                    <button name="onayVer" value="2" onClick="return confirmAgree();"><i class="fa fa-check"></i>Onay Ver</button>
                                    <button name="onayIptal" value="1" onClick="return confirmDelete();"><i class="fa fa-times"></i>Onay İptal</button>
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Onay Durumu</p>';
                                if($commentRow['comment_onay'] == 1) { echo '<p style="color: #C00;">Onay Verilmedi !</p>'; }
                                elseif($commentRow['comment_onay'] == 2) { echo '<p style="color: #9ad717;">Onay Verildi !</p>'; }
                            echo '
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Yazı Başlığı</p><p>'.$commentRow['article_name'].'</p>
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Yorum</p>
                                    <p>'.$commentRow['comment'].'</p>
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Yorum Ekleme</p><p>'.$commentRow['ad_soyad'].'</p>
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Yorum Email</p><p>'.$commentRow['email'].'</p>
                                </div>
                                <div class="CommentMainCenter-Line2">
                                    <p>Ekleme Tarihi</p><p>'.$commentRow['comment_date'].'</p>
                                </div>
                                </form>';
                        }  else { commentOnayIptal($pdo); }
                    ?>

				</div>
			</div>
			<div class="SectionRight">
				<?php PartRight($pdo); ?>
			</div>
		</section>
	</div>

</body>
</html>
<?php ob_end_flush(); ?>