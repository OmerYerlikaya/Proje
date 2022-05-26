<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
include 'header.php';
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
<script type="text/javascript">
	var genislik = $(window).width()
	if (genislik < 768) {
		function yenile(){
			$('#sidebarToggleTop').trigger('click');
		}
		setTimeout("yenile()",1);
	}
</script>


<?php
include 'footer.php';
?>

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
		"ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
		"searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
		"lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
		"info": true,
		"lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
		dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
	});
</script>

<script>
	var dataTables = $('#siparistablosu').DataTable({
		"ordering": true,  //Tabloda sıralama özelliği gözüksün mü? true veya false
		"searching": true,  //Tabloda arama yapma alanı gözüksün mü? true veya false
		"lengthChange": true, //Tabloda öğre gösterilme gözüksün mü? true veya false
		"info": true,
		"lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
		dom: "<'row '<'col-md-6'l><'col-md-6'f><'col-md-4 d-none d-print-block'B>>rtip",
	});
</script>

<?php
if (isset($_GET['durum'])) {?>
	<?php if ($_GET['durum']=="izinsiz")  {?>
		<script>
			Swal.fire({
				type: 'error',
				title: 'İzniniz Yok',
				text: 'Girme İzniniz olmayan bir alana girmeye çalıştınız',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } ?>
	<?php if ($_GET['durum']=="ok")  {?>
		<script>
			Swal.fire({
				type: 'success',
				title: 'İşlem Başarılı',
				text: 'İşleminiz Başarıyla Gerçekleştirildi',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	<?php } } ?>

