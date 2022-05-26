<?php 


ob_start();
session_start(); 
include 'islemler/baglan.php';
include 'fonksiyonlar.php';

oturumkontrol();

$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

$kullanici=$db->prepare("SELECT * FROM kullanicilar where session_mail=:mail");
$kullanici->execute(array(
	'mail' => $_SESSION['kul_mail']
));

$say=$kullanici->rowcount();
$kullanicicek=$kullanici->fetch(PDO::FETCH_ASSOC);
if ($say==0) {
	header("location:login?durum=izinsiz");
	exit;
};

/*Eğer IP Adresi Değiştiğinde Oturum Sonlandırılmasını İstemiyorsanız Aşağıdaki Satırları Silin*/

if ($kullanicicek['ip_adresi']!=$_SERVER['REMOTE_ADDR']) {
	header("location:login?durum=suphe");
	session_destroy();
	exit;
}

/*Eğer IP Adresi Değiştiğinde Oturum Sonlandırılmasını İstemiyorsanız Yukarıdaki Satırları Silin*/


?>
	<!DOCTYPE html>
	<html lang="tr" class="no-js">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="img/fav.png">
		<meta name="author" content="colorlib">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta charset="UTF-8">
		<title>Anasayfa</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/jquery-ui.css">				
			<link rel="stylesheet" href="css/nice-select.css">							
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/owl.carousel.css">				
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>	
			<header id="header">
				<div class="header-top">
					<div class="container">
			  		<div class="row align-items-center">
			  			<div class="col-lg-6 col-sm-6 col-6 header-top-left">
			  				<ul><li><a href="index.php">Bilgisayar Programcılığı</a></li></ul>
			  			</div>
			  			<div class="col-lg-6 col-sm-6 col-6 header-top-right">
							<div class="header-social">
								<a href="#"><i class="fa fa-facebook"></i></a>
								<a href="#"><i class="fa fa-twitter"></i></a>
								<a href="#"><i class="fa fa-instagram"></i></a>
								<a href="#"><i class="fa fa-youtube"></i></a>
							</div>
			  			</div>
			  		</div>			  					
					</div>
				</div>
				<div class="container main-menu">
					<div class="row align-items-center justify-content-between d-flex">
				      <div id="logo">
				        <a href="index.php"><img src="img/kbulogo.png" alt="" title="" /></a>
				      </div>
				      <nav id="nav-menu-container">
				        <ul class="nav-menu">
				          <li><a href="index.php">Anasayfa</a></li>
				          <li><a href="projeekle.php">Kişi Ekle</a></li>
				          <li><a href="projeler.php">Kişileri Listele</a></li>
				          <li><a href="log.php">Loglar</a></li>
				          <li><a href="profil.php">Kullanıcı Bilgileri</a></li>
		      	          <li><a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">Çıkış</a></li>	          					          		          
				        </ul>
				      </nav>					      		  
					</div>
				</div>
			</header>
			<section class="banner-area relative">
				<div class="overlay overlay-bg"></div>				
				<div class="container">
					<div class="row fullscreen align-items-center justify-content-between">
						<div class="col-lg-6 col-md-6 banner-left">
							<h6 class="text-white">Hilal Ekşi - Ömer Faruk Yerlikaya - Nilsu Mine Kirenli</h6>
							<h1 class="text-white">Final Projesi</h1>
						</div>
					</div>
				</div>					
			</section>		

			
			<!-- End footer Area -->	

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="js/popper.min.js"></script>
			<script src="js/vendor/bootstrap.min.js"></script>			
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>		
 			<script src="js/jquery-ui.js"></script>					
  			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>						
			<script src="js/jquery.nice-select.min.js"></script>					
			<script src="js/owl.carousel.min.js"></script>							
			<script src="js/mail-script.js"></script>	
			<script src="js/main.js"></script>	
		</body>
				<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Oturum Kapatma</h5>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">×</span>
									</button>
								</div>
								<div class="modal-body">Oturumu kapatmak istediğinize emin misiniz?</div>
								<div class="modal-footer">
									<button class="btn btn-secondary" type="button" data-dismiss="modal">İptal</button>
									
									<form class="mx-1" action="islemler/cikis.php" method="POST">
									<input type="hidden" name="kul_id" value="<?php echo $_SESSION['kul_id'] ?>">
									<button type="submit" name="cikis" class="btn btn-primary">Çıkış</button>
									</form>
								</div>
							</div>
						</div>
					</div>
	</html>
