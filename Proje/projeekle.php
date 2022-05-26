<?php 
include 'header.php';
if (yetkikontrol()!="yetkili") {
  header("location:index.php?durum=izinsiz");
  exit;
}
?>
<link rel="stylesheet" media="all" type="text/css" href="vendor/upload/css/fileinput.min.css">
<link rel="stylesheet" type="text/css" media="all" href="vendor/upload/themes/explorer-fas/theme.min.css">
<script src="vendor/upload/js/fileinput.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/fas/theme.min.js" type="text/javascript" charset="utf-8"></script>
<script src="vendor/upload/themes/explorer-fas/theme.minn.js" type="text/javascript" charset="utf-8"></script>
<!-- Begin Page Content -->
<div class="container">
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Personel Ekle</h5>
    </div>
    <div class="card-body">
      <form action="islemler/islem.php" method="POST" enctype="multipart/form-data"  data-parsley-validate>
        <div class="form-row">
         <div class="form-group col-md-6">
            <label for="inputState">Personel Grubu</label>
            <select required name="personel_grubu" class="form-control">
              <option>Web Birimi</option>
              <option>Sistem Birimi</option>
              <option>Network Birimi</option>
              <option>İdari Birim</option> 
            </select>
            </div>

          <div class="form-group col-md-6">
            <label>Personel TC</label>
            <input type="text" class="form-control" name="personel_tc" placeholder="Lütfen TC Giriniz..">
          </div>
          
         
               
           <div class="form-group col-md-6">
            <label>Personel Adı</label>
            <input type="text" class="form-control" name="personel_ad" placeholder="Lütfen Adı Giriniz..">
          </div>
            
             <div class="form-group col-md-6">
            <label>Personel Soyadı</label>
            <input type="text" class="form-control" name="personel_soyad" placeholder="Lütfen Soyadı Giriniz..">
          </div>
            
             <div class="form-group col-md-6">
            <label>Personel Mesleği</label>
            <input type="text" class="form-control" name="personel_meslek" placeholder="Lütfen Mesleği Giriniz..">
          </div>
          
           <div class="form-group col-md-6">
            <label>Mail Adresi</label>
            <input type="text" class="form-control" name="personel_mail" placeholder="Lütfen Maili Giriniz..">
          </div>
            
            <div class="form-group col-md-6">
            <label>Telefon</label>
            <input type="text" class="form-control" name="personel_tel" placeholder="Lütfen Telefonu Giriniz..">
          </div>
            
             <div class="form-group col-md-6">
            <label>Cinsiyet</label>
            <input type="text" class="form-control" name="personel_cinsiyet" placeholder="Lütfen Cinsiyet Giriniz..">
          </div>
            
               <div class="form-group col-md-6">
            <label>Doğum Tarihi</label>
            <input type="date" class="form-control" name="dogum_tarihi" placeholder="Lütfen Doğum Tarihini Giriniz..">
         </div>
          
          <div class="form-group col-md-6">
            <label>Kayıt Tarihi</label>
            <input type="date" class="form-control" name="kayit_tarihi" placeholder="Lütfen Kayıt Tarihini Giriniz..">
         </div>
            <div class="form-group col-md-12">
            <label>Adres Bilgisi</label>
            <input type="text" class="form-control" name="personel_adresi" placeholder="Lütfen Adres Giriniz..">
          </div>
            
        <div class="form-group col-md-12">
          <textarea class="ckeditor" name="personel_hakkinda" id="editor"></textarea>
        
      </div>
      <button type="submit" name="projeekle" class="btn btn-primary">Kaydet</button>
          
          </div>    
    </form>
  </div>
</div>
</div>
<!-- End of Main Content -->
<?php include 'footer.php' ?>
<script src="ckeditor/ckeditor.js"></script>
<script>
 CKEDITOR.replace('editor',{
 });
</script>
<script>
  $(document).ready(function () {
    var url1='<?php echo $ayarcek['site_logo'] ?>';
    $("#proje_dosya").fileinput({
      'theme': 'explorer-fas',
      'showUpload': false,
      'showCaption': true,
      showDownload: true,
      allowedFileExtensions: ["jpg", "png", "jpeg","mp4","zip","rar"],
    });
  });
</script>

<?php if (@$_GET['durum']=="no")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Kayıt İşlemi Gerçekleştirilemedi! Lütfen Tekrar Deneyin.',
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
      text: 'Kayıt İşleminiz Başarıyla Gerçekleştirildi',
      showConfirmButton: false,
      timer: 2000
    })
  </script>
<?php } ?>

<?php if (@$_GET['durum']=="hata")  {?>  
  <script>
    Swal.fire({
      type: 'error',
      title: 'İşlem Başarısız',
      text: 'Hata İle Karşılaşıldı. Lütfen İşlemlerinizi Kontrol Ederek Tekrar Deneyin.',
      showConfirmButton: false,
      timer: 3000
    })
  </script>
  <?php } ?>