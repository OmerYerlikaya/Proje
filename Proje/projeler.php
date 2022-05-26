<?php 
include'header.php' 
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style type="text/css" media="screen">
  @media only screen and (max-width: 700px) {
    .mobilgizle {
      display: none;
    }
    .mobilgizleexport {
      display: none;
    }
    .mobilgoster {
      display: block;
    }
  }
  @media only screen and (min-width: 700px) {
    .mobilgizleexport {
      display: flex;
    }
    .mobilgizle {
      display: block;
    }
    .mobilgoster {
      display: none;
    }
  }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Kişi Listele</h6>
    </div>
    <div class="card-body" style="width: 100%">
      <!--Tablo filtreleme butonları mobilde gizlendiğinde gözükecek buton-->
      <button type="button"class="btn btn-sm btn-info btn-icon-split mobilgoster">
        <span class=" text-white-65">
          <i class="fas fa-edit"></i>
        </span>
        <span class="text">Seçenekler</span>
      </button>

      <div class="mobilgizle gizlemeyiac" style="margin-bottom: 10px;">
        <!--Tablo filtreleme butonları bölümü giriş-->
        <button type="button" id="hepsi" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split col-md-2">
          <span class=" text-white-65">
          </span>
          <span class="text">Hepsi</span>
        </button>

        <button type="button" id="web" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split col-md-2">
          <span class=" text-white-65">
          </span>
          <span class="text">Web Birimi</span>
        </button>

        <button type="button" id="sistem" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split col-md-2">
          <span class=" text-white-65">
          </span>
          <span class="text">Sistem Birimi</span>
        </button>

        <button type="button" id="network" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split col-md-2">
          <span class=" text-white-65">
          </span>
          <span class="text">Network Birimi</span>
        </button>

        <button type="button" id="idari" style="margin-bottom: 5px;" class="btn btn-sm btn-primary btn-icon-split col-md-2">
          <span class=" text-white-65">
          </span>
          <span class="text">İdari Birim</span>
        </button>

        
        <!--Tablo filtreleme butonları bölümü çıkış-->

      
      <!--Tabloyu excel-pdf-csv olarak dışa aktarma butonlarının olduğu alan çıkış-->
    </div>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr> 
            <th>No</th>
            <th>Grup Bilgisi</th>
            <th>TC</th>
            <th>Adı</th>
            <th>Soyadı</th>
            <th>Mail</th>
            <th>Cinsiyet</th>
			<th>Telefon</th>
            <th>Adres</th>
            <th>Doğum Tarihi</th>
            <th>Personel Hakında</th>
		    <th>Kayıt Tarihi</th>
            <th>İşlem</th>
          </tr>
        </thead>
        <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi giriş-->
        <tbody>
         <?php 
         $say=0;
         $projesor=$db->prepare("SELECT * FROM proje ORDER BY proje_id DESC");
         $projesor->execute();
         while ($projecek=$projesor->fetch(PDO::FETCH_ASSOC)) { $say++?>

           <tr>
            <td><?php echo $say; ?></td>
            <td><?php echo $projecek['personel_grubu']; ?></td>
            <td><?php echo $projecek['personel_tc']; ?></td>
            <td><?php echo $projecek['personel_ad']; ?></td>
            <td><?php echo $projecek['personel_soyad']; ?></td>
			<td><?php echo $projecek['personel_mail']; ?></td>
            <td><?php echo $projecek['personel_cinsiyet']; ?></td>
		    <td><?php echo $projecek['personel_tel']; ?></td>
            <td><?php echo $projecek['personel_adres']; ?></td>
            <td><?php echo $projecek['dogum_tarihi']; ?></td>
            <td><?php echo $projecek['personel_hakkinda']; ?></td>
            <td><?php echo $projecek['kayit_tarihi']; ?></td>

          <td>

            <?php 
            if (yetkikontrol()=="yetkili") {?>
             <div class="d-flex justify-content-center">
              <form action="projeduzenle.php" method="POST">
                <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                <button type="submit" name="duzenleme" class="btn btn-success btn-sm">
                  <span class="icon text-white-60"><p>Düzenle</p></span>
                </button>
              </form>
              <form class="mx-1" action="islemler/islem.php" method="POST">
                <input type="hidden" name="proje_id" value="<?php echo $projecek['proje_id'] ?>">
                <button type="submit" name="projesilme" class="btn btn-danger btn-sm btn-icon-split">
                  <span class="icon text-white-60"><p>Sil</p></span>
                </button>
              </form>
            <?php } ?>
          </div>
        </td>
      </tr>
    <?php } ?>
  </tbody>

  <!--While döngüsü ile veritabanında ki verilerin tabloya çekilme işlemi çıkış-->
</table>
</div>
</div>
</div>
<!--Datatables çıkış-->
</div>


<?php include'footer.php' ?>

<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script> 
<script src="vendor/datatables/dataTables.buttons.min.js"></script>
<script src="vendor/datatables/buttons.flash.min.js"></script>
<script src="vendor/datatables/jszip.min.js"></script>
<script src="vendor/datatables/pdfmake.min.js"></script>
<script src="vendor/datatables/vfs_fonts.js"></script>
<script src="vendor/datatables/buttons.html5.min.js"></script>
<script src="vendor/datatables/buttons.print.min.js"></script>

<script type="text/javascript">
  $("#aktarmagizleme").click(function(){
    $(".dt-buttons").toggle();
  });
</script>
<script type="text/javascript">
  $(".mobilgoster").click(function(){
    $(".gizlemeyiac").toggle();
  });
</script>
<script>
  var dataTables = $('#dataTable').DataTable({
    initComplete: function () {
      this.api().columns([2,3,4]).every( function () {
        var column = this;
        var select = $('<select class="filtre"><option value=""></option></select>')
        .appendTo( $(column.footer()).empty() )
        .on( 'change', function () {
          var val = $.fn.dataTable.util.escapeRegex(
            $(this).val()
            );

          column
          .search( val ? '^'+val+'$' : '', true, false )
          .draw();
        });

        column.data().unique().sort().each( function ( d, j ) {
         var val = $('<div/>').html(d).text();
          
          if (val.length>29) {
            filtremetin =  val.substr(0,30)+"...";
          } else {
            filtremetin=val;
          }
          select.append( '<option value="' + val + '">' + filtremetin + '</option>' )
        });
      });
    },
    "ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
    "searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
    "lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
    "info": true,
    dom: "<'row mobilgizleexport gizlemeyiac'<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
    buttons: [
    {
      extend: 'copyHtml5', 
      className: 'kopyalama-buton',
    },
    {
      extend: 'excelHtml5', 
      className: 'excel-buton',
    },
    {
     extend: 'pdfHtml5',
     className: 'pdf-buton',
   },
   {
    extend: 'csvHtml5',
    className: 'csv-buton',
  }
  ]
});
  //Sonradan yapılan butona tıklandığında asıl dışa aktarma butonunun çalışması
  function fnAction(action) {
    switch (action) {
      case "excel":
      $('.excel-buton').trigger('click');
      break;
      case "pdf":
      $('.pdf-buton').trigger('click');
      break;
      case "copy":
      $('.kopyalama-buton').trigger('click');
      break;
      case "csv":
      $('.csv-buton').trigger('click');
      break;
    }
  }
  //Tablo filtreleme işlemleri
  $('#hepsi').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(1).search("").draw();
  }); 
  $('#web').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(1).search("Web Birimi").draw();
  }); 
  $('#sistem').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(1).search("Sistem Birimi").draw();
  }); 
  $('#network').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(1).search("Network Birimi").draw();
  }); 
  $('#idari').on('click', function () {
    dataTables
    .columns()
    .search( '' )
    .columns( '.sold_out' )
    .search( 'YES' )
    .draw();
    dataTables.column(1).search("İdari Birim").draw();
  });
</script>

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
      text: 'Yapmamanız Gereken Şeyler Yapıyorsunuz!',
      showConfirmButton: false,
      timer: 3000
    })
  </script>
  <?php } ?>