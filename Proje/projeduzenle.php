<?php 
include 'header.php' ;

if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
}

if (isset($_POST['proje_id'])) {
	$projesor=$db->prepare("SELECT * FROM proje where proje_id=:id");
	$projesor->execute(array(
		'id' => guvenlik($_POST['proje_id'])
	));
	$projecek=$projesor->fetch(PDO::FETCH_ASSOC);
} else {
	header("location:projeler");
} 
?>
<?php
$per_grubu=$projecek['personel_grubu'];
$dt = \DateTime::createFromFormat('m/d/Y', $projecek['dogum_tarihi']);
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">Personel Düzenleme Sayfası   
						<small>
							<?php 
							if (isset($_GET['islem'])) { 
								if ($_GET['islem']=="ok") {?> 
									<b style="color: green; font-size: 16px;">İşlem Başarılı</b>
								<?php } elseif ($_GET['islem']=="no") { ?> 
									<b style="color: red; font-size: 16px;">İşlem Başarısız</b>
								<?php } } ?>

							</small>
						</h5>
					</div>
					<div class="card-body">
					  <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
						<div class="form-row">
						 <div class="form-group col-md-6">
							<label for="inputState">Personel Grubu</label>
							<select required name="personel_grubu" class="form-control">
							  <option <?php echo $sonuc=($per_grubu=="Web Birimi")? "selected":""; ?>>Web Birimi</option>
							  <option <?php echo $sonuc=($per_grubu=="Sistem Birimi")? "selected":""; ?>>Sistem Birimi</option>
							  <option <?php echo $sonuc=($per_grubu=="Network Birimi")? "selected":""; ?>>Network Birimi</option>
							  <option <?php echo $sonuc=($per_grubu=="İdari Birim")? "selected":""; ?>>İdari Birim</option> 
							</select>
							</div>

						  <div class="form-group col-md-6">
							<label>Personel TC</label>
							<input type="text" class="form-control" name="personel_tc" placeholder="Lütfen TC Giriniz.." value="<?php echo $projecek['personel_tc'] ?>">
						  </div>
						  
						 
							   
						   <div class="form-group col-md-6">
							<label>Personel Adı</label>
							<input type="text" class="form-control" name="personel_ad" placeholder="Lütfen Adı Giriniz.." value="<?php echo $projecek['personel_ad'] ?>">
						  </div>
							
							 <div class="form-group col-md-6">
							<label>Personel Soyadı</label>
							<input type="text" class="form-control" name="personel_soyad" placeholder="Lütfen Soyadı Giriniz.." value="<?php echo $projecek['personel_soyad'] ?>">
						  </div>
							
							 <div class="form-group col-md-6">
							<label>Personel Mesleği</label>
							<input type="text" class="form-control" name="personel_meslek" placeholder="Lütfen Mesleği Giriniz.." value="<?php echo $projecek['personel_meslek'] ?>">
						  </div>
						  
						   <div class="form-group col-md-6">
							<label>Mail Adresi</label>
							<input type="text" class="form-control" name="personel_mail" placeholder="Lütfen Maili Giriniz.." value="<?php echo $projecek['personel_mail'] ?>">
						  </div>
							
							<div class="form-group col-md-6">
							<label>Telefon</label>
							<input type="text" class="form-control" name="personel_tel" placeholder="Lütfen Telefonu Giriniz.." value="<?php echo $projecek['personel_tel'] ?>">
						  </div>
							
							 <div class="form-group col-md-6">
							<label>Cinsiyet</label>
							<input type="text" class="form-control" name="personel_cinsiyet" placeholder="Lütfen Cinsiyet Giriniz.." value="<?php echo $projecek['personel_cinsiyet'] ?>">
						  </div>
							
							   <div class="form-group col-md-6">
							<label>Doğum Tarihi</label>
							<input type="date" class="form-control" name="dogum_tarihi" placeholder="Lütfen Doğum Tarihini Giriniz.." value="<?php echo date('Y-m-d',strtotime($projecek['dogum_tarihi'])) ?>">
						 </div>
						  
						  <div class="form-group col-md-6">
							<label>Kayıt Tarihi</label>
							<input type="date" class="form-control" name="kayit_tarihi" placeholder="Lütfen Kayıt Tarihini Giriniz.." value="<?php echo date('Y-m-d',strtotime($projecek['kayit_tarihi'])) ?>">
						 </div>
							<div class="form-group col-md-12">
							<label>Adres Bilgisi</label>
							<input type="text" class="form-control" name="personel_adresi" placeholder="Lütfen Adres Giriniz.." value="<?php echo $projecek['personel_adres'] ?>">
						  </div>
							
						<div class="form-group col-md-12">
						  <textarea class="ckeditor" name="personel_hakkinda" id="editor"><?php echo $projecek['personel_hakkinda'] ?></textarea>
						
					  </div>
					  <input type="hidden" class="form-control" name="proje_id" value="<?php echo $_POST['proje_id'] ?>">
					  <button type="submit" name="projeguncelle" class="btn btn-primary">Güncelle</button>
						  
						  </div>    
					</form>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor' );
</script>
<?php 
if (strlen($dosyayolu)>10) {?>
	<script>
		$(document).ready(function () {
			var url1='<?php echo $dosyayolu ?>'
			$("#projedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
			initialPreview: [
			'<img src="<?php echo $dosyayolu ?>" style="height:100px" class="file-preview-image" alt="Dosya" title="Dosya">'
			],
			initialPreviewConfig: [
			{downloadUrl: url1,
				showRemove: false,
			},
			],
		});

		});
	</script>
<?php } else { ?>
	<script>
		$(document).ready(function () {
			$("#projedosya").fileinput({
				'theme': 'explorer-fas',
				'showUpload': false,
				'showCaption': true,
				'showDownload': true,
			//	'initialPreviewAsData': true,
			allowedFileExtensions: ["jpg", "png", "jpeg", "mp4", "zip", "rar"],
		});

		});
	</script>
	<?php } ?>
