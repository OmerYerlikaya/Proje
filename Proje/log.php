<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
	header("location:index.php?durum=izinsiz");
	exit;
};
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>

    <div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Loglar</h6>
    </div>
    <div class="card-body" style="width: 100%">
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr> 
			<th>No</th>
            <th>Log Id</th>
            <th>Kullanıcı Ad Soyad</th>
            <th>Ip Adress</th>
            <th>İşlem Tarihi</th>
            <th>İşlem Türü</th>
          </tr>
        </thead>
        <tbody>
         <?php 
        $say=0;

         $projesor=$db->prepare("SELECT * FROM loglar where kul_id={$_SESSION['kul_id']} order by log_id DESC");
         $projesor->execute();
         while ($projecek=$projesor->fetch(PDO::FETCH_ASSOC)) { $say++?>

           <tr>
            <td><?php echo $say; ?></td>
            <td><?php echo $projecek['log_id']; ?></td>
            <td><?php $isimsor=$db->prepare("select kul_isim from kullanicilar where kul_id={$projecek['kul_id']}"); $isimsor->execute(); $isim=$isimsor->fetch(PDO::FETCH_ASSOC); echo $isim['kul_isim']; ?></td>
            <td><?php echo $projecek['ip_adress']; ?></td>
            <td><?php echo $projecek['log_tarihi']; ?></td>
            <td><?php echo guvenlik($projecek['islem']); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>

<script type="text/javascript">
	var genislik = $(window).width()   
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>
<?php include 'footer.php' ?>

<?php if (@$_GET['durum']=="no")  {?>  
	<script>
		Swal.fire({
			type: 'error',
			title: 'İşlem Başarısız',
			text: 'Lütfen Tekrar Deneyin',
			showConfirmButton: true,
			confirmButtonText: 'Kapat'
		})
	</script>
<?php } ?>

<?php if (@$_GET['durum']=="ok")  {?>  
	<script>
		Swal.fire({
			type: 'success',
			title: 'İşlem Başarılı',
			text: 'İşleminiz Başarıyla Gerçekleştirildi',
			showConfirmButton: true,
			confirmButtonText: 'Kapat'
		})
	</script>
	<?php } ?>