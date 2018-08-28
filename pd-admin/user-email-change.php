<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/UserEmailChange.php');

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
	<link rel="stylesheet" type="text/css" href="css/user.css">
	<link rel="stylesheet" type="text/css" href="includes/fa/css/font-awesome.min.css">
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/jquery-1.2.1.min.js"></script>
	<script type="text/javascript" src="js/menu-collapsed.js"></script>
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
				<div class="UserMainHeader">
					<p><a href="users.php"><i class="fa fa-reply"></i></a>ÜYELİK | E-MAİL DEĞİŞTİR</p>
				</div>
				<div class="UserMainCenter2">
                    <?php
                        if(!isset($_POST['emailDegistir'])) {
                            echo '
                            <form action="#" method="post">
                            <div class="UserMainCenter-Line2">
                                <p>Şuanki E-Mail</p>
                                <p><input type="text" name="email_now" /></p>
                            </div>
                            <div class="UserMainCenter-Line2">
                                <p>Yeni E-Mail</p>
                                <p><input type="text" name="email" /></p>
                            </div>
                            <div class="UserMainCenter-Line2">
                                <p>Yeni E-Mail Tekrar</p>
                                <p><input type="text" name="email2" /></p>
                            </div>
                            <button name="emailDegistir" class="NewButton"><i class="fa fa-envelope-o"></i>E-MAİL DEĞİŞTİR</button>
                            </form>';
                        } else { userEmailChange($pdo); }
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