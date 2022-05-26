<?php 
include 'baglan.php';
if (isset($_POST['cikis'])) {
	$logkaydet=$db->prepare("INSERT INTO loglar SET
			kul_id=:kul_id,
			ip_adress=:ip_adress,
			islem=:islem
		");
		$kaydetlog=$logkaydet->execute(array(
			'kul_id' => $_POST['kul_id'],
			'ip_adress' => $_SERVER['REMOTE_ADDR'],
			'islem' => 'Çıkış'
		));
}
		
session_start();
session_destroy();
header("location:../login.php")
 ?>