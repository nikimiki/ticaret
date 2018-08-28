<?php
    include_once('includes/connect.php');
    include('includes/TemplateParts.php');
    include('includes/change/UserChange.php');

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
    <script type="text/javascript">
        function selectCinsiyet(c) {
            document.getElementById("cinsiyet_one").style.display = "none";
            document.getElementById("cinsiyet_two").style.display = "none";
            document.getElementById(c).style.display = "inline";
        }
        function selectDTarih(d) {
            document.getElementById("dtarih_one").style.display = "none";
            document.getElementById("dtarih_two").style.display = "none";
            document.getElementById(d).style.display = "inline";
        }
        function selectOgrenim(o) {
            document.getElementById("ogrenim_one").style.display = "none";
            document.getElementById("ogrenim_two").style.display = "none";
            document.getElementById(o).style.display = "inline";
        }
        function selectKayit(k) {
            document.getElementById("kayit_one").style.display = "none";
            document.getElementById("kayit_two").style.display = "none";
            document.getElementById(k).style.display = "inline";
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
				<div class="UserMainHeader">
					<p><a href="user-change.php"><i class="fa fa-reply"></i></a>ÜYELİK FORMU | DEĞİŞTİR</p>
				</div>
				<div class="UserMainCenter2">
                    <?php
                        if(!isset($_POST['userDegistir'])) {
                            $id = $_GET['userChange'];
                            $userSQL = $pdo->query("SELECT
                            id, ad, soyad, cinsiyet, dtarih, ogrenim, picture, kayit_tur
                            FROM users WHERE id = '$id'")->fetch(PDO::FETCH_ASSOC);
                            $userRow = $userSQL;

                            $cinsiyet_one = "javascript:selectCinsiyet('cinsiyet_one')";
                            $cinsiyet_two = "javascript:selectCinsiyet('cinsiyet_two')";

                            $dtarih_one = "javascript:selectDTarih('dtarih_one')";
                            $dtarih_two = "javascript:selectDTarih('dtarih_two')";

                            $ogrenim_one = "javascript:selectOgrenim('ogrenim_one')";
                            $ogrenim_two = "javascript:selectOgrenim('ogrenim_two')";

                            $kayit_one = "javascript:selectKayit('kayit_one')";
                            $kayit_two = "javascript:selectKayit('kayit_two')";

                            echo '
                                    <form action="#" method="post">
                                    <h3>Kişisel Bilgiler</h3>
                                    <div class="UserProfilPicture">';
                                        if($userRow['picture'] == '') { echo '<img src="images/logo-picture.jpg" alt="'.$userRow['ad'].' - Profil Resmi"/>'; }
                                        else { echo '<img src="pic/'.$userRow['picture'].'" alt="'.$userRow['ad'].' - Profil Resmi"/>'; }
                            echo '
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Adınız</p>
                                        <p><input type="text" name="ad" value="'.$userRow['ad'].'" /></p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Soyadınız</p>
                                        <p><input type="text" name="soyad" value="'.$userRow['soyad'].'" /></p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Cinsiyet</p>
                                        <p>
                                            <input type="radio" name="cinsiyet_degis" value="0" onclick="'.$cinsiyet_one.'" checked="checked" /> <span style="width:120px;">Cinsiyet değiştirme</span>
                                            <input type="radio" name="cinsiyet_degis" value="1" onclick="'.$cinsiyet_two.'" unchecked /> <span style="width:120px;">Cinsiyet değiştir</span>

                                            <div id="cinsiyet_one" class="UserSecenek" style="display: visible;">
                                                <i class="fa fa-eye"></i> &nbsp;&nbsp;&nbsp;';
                                                if($userRow['cinsiyet'] == 1) { echo 'Bay &nbsp;&nbsp;<i class="fa fa-male" style="color: #314a61;"></i>'; }
                                                elseif($userRow['cinsiyet'] == 2) { echo 'Bayan &nbsp;&nbsp;<i class="fa fa-female" style="color: #C00;"></i>'; }
                            echo '
                                            </div>
                                            <div id="cinsiyet_two" class="UserSecenek" style="display: none;">
                                                <input type="radio" name="cinsiyet" checked="checked" value="1" /> Bay &nbsp;&nbsp;<i class="fa fa-male" style="color: #314a61;"></i>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="cinsiyet" unchecked value="2" /> Bayan &nbsp;&nbsp;<i class="fa fa-female" style="color: #C00;"></i>
                                            </div>';

                            echo '
                                        </p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Doğum Tarihi</p>
                                        <p>
                                            <input type="radio" name="dtarih_degis" value="0" onclick="'.$dtarih_one.'" checked="checked" /> <span style="width:150px;">Doğum Tarihi değiştirme</span>
                                            <input type="radio" name="dtarih_degis" value="1" onclick="'.$dtarih_two.'" unchecked /> <span style="width:150px;">Doğum Tarihi değiştir</span>

                                            <div id="dtarih_one" class="UserSecenek" style="display: visible;">
                                                <i class="fa fa-eye"></i> &nbsp;&nbsp;&nbsp;'.$userRow['dtarih'].'
                                            </div>
                                            <div id="dtarih_two" class="UserSecenek" style="display: none;">
                                            <select name="gun" style="width:100px;">
                                                <option value="0">Gün</option>
                                                <option value="01">1</option>
                                                <option value="02">2</option>
                                                <option value="03">3</option>
                                                <option value="04">4</option>
                                                <option value="05">5</option>
                                                <option value="06">6</option>
                                                <option value="07">7</option>
                                                <option value="08">8</option>
                                                <option value="09">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">16</option>
                                                <option value="17">17</option>
                                                <option value="18">18</option>
                                                <option value="19">19</option>
                                                <option value="20">20</option>
                                                <option value="21">21</option>
                                                <option value="22">22</option>
                                                <option value="23">23</option>
                                                <option value="24">24</option>
                                                <option value="25">25</option>
                                                <option value="26">26</option>
                                                <option value="27">27</option>
                                                <option value="28">28</option>
                                                <option value="29">29</option>
                                                <option value="30">30</option>
                                                <option value="31">31</option>
                                            </select>
                                            <select name="ay" style="width:100px;">
                                                <option value="0">Ay</option>
                                                <option value="01">Ocak</option>
                                                <option value="02">Şubat</option>
                                                <option value="03">Mart</option>
                                                <option value="04">Nisan</option>
                                                <option value="05">Mayıs</option>
                                                <option value="06">Haziran</option>
                                                <option value="07">Temmuz</option>
                                                <option value="08">Ağustos</option>
                                                <option value="09">Eylül</option>
                                                <option value="10">Ekim</option>
                                                <option value="11">Kasım</option>
                                                <option value="12">Aralık</option>
                                            </select>
                                            <select name="yil" style="width:100px;">
                                                <option value="0">Yıl</option>
                                                <option value="1940">1940</option>
                                                <option value="1941">1941</option>
                                                <option value="1942">1942</option>
                                                <option value="1943">1943</option>
                                                <option value="1944">1944</option>
                                                <option value="1945">1945</option>
                                                <option value="1946">1946</option>
                                                <option value="1947">1947</option>
                                                <option value="1948">1948</option>
                                                <option value="1949">1949</option>
                                                <option value="1950">1950</option>
                                                <option value="1951">1951</option>
                                                <option value="1952">1952</option>
                                                <option value="1953">1953</option>
                                                <option value="1954">1954</option>
                                                <option value="1955">1955</option>
                                                <option value="1956">1956</option>
                                                <option value="1957">1957</option>
                                                <option value="1958">1958</option>
                                                <option value="1959">1959</option>
                                                <option value="1960">1960</option>
                                                <option value="1961">1961</option>
                                                <option value="1962">1962</option>
                                                <option value="1963">1963</option>
                                                <option value="1964">1964</option>
                                                <option value="1965">1965</option>
                                                <option value="1966">1966</option>
                                                <option value="1967">1967</option>
                                                <option value="1968">1968</option>
                                                <option value="1969">1969</option>
                                                <option value="1970">1970</option>
                                                <option value="1971">1971</option>
                                                <option value="1972">1972</option>
                                                <option value="1973">1973</option>
                                                <option value="1974">1974</option>
                                                <option value="1975">1975</option>
                                                <option value="1976">1976</option>
                                                <option value="1977">1977</option>
                                                <option value="1978">1978</option>
                                                <option value="1979">1979</option>
                                                <option value="1980">1980</option>
                                                <option value="1981">1981</option>
                                                <option value="1982">1982</option>
                                                <option value="1983">1983</option>
                                                <option value="1984">1984</option>
                                                <option value="1985">1985</option>
                                                <option value="1986">1986</option>
                                                <option value="1987">1987</option>
                                                <option value="1988">1988</option>
                                                <option value="1989">1989</option>
                                                <option value="1990">1990</option>
                                                <option value="1991">1991</option>
                                                <option value="1992">1992</option>
                                                <option value="1993">1993</option>
                                                <option value="1994">1994</option>
                                                <option value="1995">1995</option>
                                                <option value="1996">1996</option>
                                                <option value="1997">1997</option>
                                                <option value="1998">1998</option>
                                                <option value="1999">1999</option>
                                                <option value="2000">2000</option>
                                                <option value="2001">2001</option>
                                                <option value="2002">2002</option>
                                                <option value="2003">2003</option>
                                                <option value="2004">2004</option>
                                                <option value="2005">2005</option>
                                                <option value="2006">2006</option>
                                                <option value="2007">2007</option>
                                                <option value="2008">2008</option>
                                                <option value="2009">2009</option>
                                                <option value="2010">2010</option>
                                                <option value="2011">2011</option>
                                                <option value="2012">2012</option>
                                                <option value="2013">2013</option>
                                                <option value="2014">2014</option>
                                                <option value="2015">2015</option>
                                            </select>
                                            </div>
                                        </p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Öğrenim Durumu</p>
                                        <p>
                                             <input type="radio" name="ogrenim_degis" value="0" onclick="'.$ogrenim_one.'" checked="checked" /> <span style="width:180px;">Öğrenim Durumu değiştirme</span>
                                             <input type="radio" name="ogrenim_degis" value="1" onclick="'.$ogrenim_two.'" unchecked /> <span style="width:180px;">Öğrenim Durumu değiştir</span>

                                             <div id="ogrenim_one" class="UserSecenek" style="display: visible;">
                                                <i class="fa fa-eye"></i> &nbsp;&nbsp;&nbsp;';
                                                if($userRow['ogrenim'] == 0) { echo 'Öğrenim Durumu Belli Değil'; }
                                                elseif($userRow['ogrenim'] == 1) { echo 'İlkokul'; }
                                                elseif($userRow['ogrenim'] == 2) { echo 'Ortaokul'; }
                                                elseif($userRow['ogrenim'] == 3) { echo 'Lise'; }
                                                elseif($userRow['ogrenim'] == 4) { echo 'Lisans'; }
                                                elseif($userRow['ogrenim'] == 5) { echo 'Lisans Üstü'; }
                                                elseif($userRow['ogrenim'] == 6) { echo 'Master'; }
                                                elseif($userRow['ogrenim'] == 7) { echo 'Doktora'; }
                            echo '
                                            </div>
                                            <div id="ogrenim_two" class="UserSecenek" style="display: none;">
                                            <select name="ogrenim" style="width: 320px;">
                                                <option value="0">Ögrenim Durumu</option>
                                                <option value="1">İlkokul</option>
                                                <option value="2">Ortaokul</option>
                                                <option value="3">Lise</option>
                                                <option value="4">Lisans</option>
                                                <option value="5">Lisans Üstü</option>
                                                <option value="6">Master</option>
                                                <option value="7">Doktora</option>
                                            </select>
                                            </div>
                                        </p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <p>Kayıt Türü</p>
                                        <p>
                                            <input type="radio" name="kayit_degis" value="0" onclick="'.$kayit_one.'" checked="checked" /> <span style="width:150px;">Kayıt Türü değiştirme</span>
                                            <input type="radio" name="kayit_degis" value="1" onclick="'.$kayit_two.'" unchecked /> <span style="width:150px;">Kayıt Türü değiştir</span>

                                            <div id="kayit_one" class="UserSecenek" style="display: visible;">
                                                 <i class="fa fa-eye"></i> &nbsp;&nbsp;&nbsp;';
                                            if($userRow['kayit_tur'] == 1) { echo '<span style="color: #C00;float: none;">Yönetici</span>'; }
                                            elseif($userRow['kayit_tur'] == 2) { echo '<span style="color:#ed6c44;float: none;">Moderatör</span>'; }
                                            elseif($userRow['kayit_tur'] == 3) { echo '<span style="color:#d8c20c;float: none;">Yazar</span>'; }
                                            elseif($userRow['kayit_tur'] == 4) { echo '<span style="float: none;">Üye</span>'; }
                            echo '
                                            </div>
                                            <div id="kayit_two" class="UserSecenek" style="display: none;">
                                            <input type="radio" name="kayit_tur" value="1" /> <span style="color: #C00;float: none;">Yönetici</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="kayit_tur" value="2" /> <span style="color:#ed6c44;float: none;">Moderatör</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="kayit_tur" value="3" /> <span style="color:#d8c20c;float: none;">Yazar</span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="radio" name="kayit_tur" checked="checked" value="4" /> <span style="float: none;">Üye</span>
                                            </div>
                                            <input type="hidden" value="'.$id.'"/>';
                            echo '
                                        </p>
                                    </div>
                                    <div class="UserMainCenter-Line2">
                                        <button name="userDegistir"><i class="fa fa-exchange"></i>DEĞİŞTİR</button>
                                    </div>
                                    </form>
                            '; } else { userChange($pdo); }
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