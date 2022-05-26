<?php


@ob_start();
@session_start();
include 'baglan.php';
include '../fonksiyonlar.php';

//Site ayarlarını veritabanından çekme işlemi
$ayarsor=$db->prepare("SELECT * FROM ayarlar");
$ayarsor->execute();
$ayarcek=$ayarsor->fetch(PDO::FETCH_ASSOC);

/********************************************************************************/

/*Oturum Açma İşlemi Giriş*/
if (isset($_POST['oturumac'])) {
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          header("location:../login?durum=captcha");
          exit;
        }
	$secretKey = "6Lfr8t4aAAAAAEHJUuO-avVg2VPteQWXH-h4e4RT";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response,true);
    if(intval($responseKeys["success"]) !== 1) 
	{
      header("location:../login?durum=suphe");
    } 
	else 
	{
	$kul_mail=guvenlik($_POST['kul_mail']);
	$kul_sifre=md5($_POST['kul_sifre']);
	$kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:mail and kul_sifre=:sifre");
	$kullanicisor->execute(array(
		'mail'=> $kul_mail,
		'sifre'=> $kul_sifre
	));
	$sonuc=$kullanicisor->rowCount();
	if ($sonuc==1) {
		$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
		$_SESSION['kul_mail']=sifreleme($kul_mail); //Session güvenliği için sessionumuzu üç aşamalı oalrak şifreliyoruz
		$_SESSION['kul_id']=$kullanicicek['kul_id'];

		$ipkaydet=$db->prepare("UPDATE kullanicilar SET
			ip_adresi=:ip_adresi, 
			session_mail=:session_mail WHERE 
			kul_mail=:kul_mail
			");

		$kaydet=$ipkaydet->execute(array(
			'ip_adresi' => $_SERVER['REMOTE_ADDR'], //Güvenlik için işlemine karşı kullanıcının ip adresini veritabanına kayıt ediyoruz
			'session_mail' => sifreleme($kul_mail),
			'kul_mail' => $kul_mail
		));
		
		$logkaydet=$db->prepare("INSERT INTO loglar SET
			kul_id=:kul_id,
			ip_adress=:ip_adress,
			islem=:islem
		");
		$kaydetlog=$logkaydet->execute(array(
			'kul_id' => $_SESSION['kul_id'],
			'ip_adress' => $_SERVER['REMOTE_ADDR'],
			'islem' => 'Giriş'
		));
		
		header("location:../index.php");
		exit;
	} else {
		header("location:../login?durum=hata");
	}
	exit;
	}
}


/*******************************************************************************/


//personel Ekleme Bölümü
          if (isset($_POST['projeekle'])) {
            if (yetkikontrol()!="yetkili") {
              header("location:../index.php");
              exit;
            }

//personel detaylarını veritabanınına kayıt etme
            $projeekle=$db->prepare("INSERT INTO proje SET
             personel_grubu=:per_grubu,
             personel_tc=:per_tc,
             personel_ad=:per_ad,
             personel_soyad=:per_soyad,
             personel_meslek=:per_meslek,
             personel_mail=:per_mail,
             personel_tel=:per_tel,
             personel_cinsiyet=:per_cinsiyet,
             dogum_tarihi=:d_tarihi,
             kayit_tarihi=:k_tarihi,
             personel_adres=:per_adrs,
             personel_hakkinda=:per_hakkinda
             
             ");
			
            $ekleme=$projeekle->execute(array(
             'per_grubu' => guvenlik($_POST['personel_grubu']),
             'per_tc' => guvenlik($_POST['personel_tc']),
             'per_ad' => guvenlik($_POST['personel_ad']),
             'per_soyad' => guvenlik($_POST['personel_soyad']),
             'per_meslek' => guvenlik($_POST['personel_meslek']),
             'per_mail' => guvenlik($_POST['personel_mail']),
             'per_tel' => guvenlik($_POST['personel_tel']),
             'per_cinsiyet' => guvenlik($_POST['personel_cinsiyet']),
             'd_tarihi' => guvenlik($_POST['dogum_tarihi']),
             'k_tarihi' => guvenlik($_POST['kayit_tarihi']),
             'per_adrs' => guvenlik($_POST['personel_adresi']),
             'per_hakkinda' => $_POST['personel_hakkinda']
                
           ));

            if ($ekleme) {
             header("location:../projeekle?durum=ok");
             exit;
           } else {
             header("location:../projeekle?durum=no");
             exit;
           }
           exit;
         }


/********************************************************************************/


         if (isset($_POST['projeguncelle'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $pguncelle=$db->prepare("UPDATE proje SET
             personel_grubu=:per_grubu,
             personel_tc=:per_tc,
             personel_ad=:per_ad,
             personel_soyad=:per_soyad,
             personel_meslek=:per_meslek,
             personel_mail=:per_mail,
             personel_tel=:per_tel,
             personel_cinsiyet=:per_cinsiyet,
             dogum_tarihi=:d_tarihi,
             kayit_tarihi=:k_tarihi,
             personel_adres=:per_adres,
             personel_hakkinda=:per_hakkinda where proje_id={$_POST['proje_id']}");

          $guncelle=$pguncelle->execute(array(
		     'per_grubu' => guvenlik($_POST['personel_grubu']),
             'per_tc' => guvenlik($_POST['personel_tc']),
             'per_ad' => guvenlik($_POST['personel_ad']),
             'per_soyad' => guvenlik($_POST['personel_soyad']),
             'per_meslek' => guvenlik($_POST['personel_meslek']),
             'per_mail' => guvenlik($_POST['personel_mail']),
             'per_tel' => guvenlik($_POST['personel_tel']),
             'per_cinsiyet' => guvenlik($_POST['personel_cinsiyet']),
             'd_tarihi' => guvenlik($_POST['dogum_tarihi']),
             'k_tarihi' => guvenlik($_POST['kayit_tarihi']),
             'per_adres' => guvenlik($_POST['personel_adres']),
             'per_hakkinda' => $_POST['personel_hakkinda']
              
          ));
         

          if ($guncelle) {
            header("location:../projeler?durum=ok");
            exit;
          } else {
            header("location:../projeler?durum=no");
            exit;
          }
          exit;
        }

		
/********************************************************************************/


      if (isset($_POST['sifreguncelle'])) {
        if (yetkikontrol()!="yetkili") {
          header("location:../index.php");
          exit;
        }
        $eskisifre=guvenlik($_POST['eskisifre']);
        $yenisifre_bir=guvenlik($_POST['yenisifre_bir']); 
        $yenisifre_iki=guvenlik($_POST['yenisifre_iki']);

        $kul_sifre=md5($eskisifre);

        $kullanicisor=$db->prepare("SELECT * FROM kullanicilar WHERE kul_sifre=:sifre AND kul_id=:id");
        $kullanicisor->execute(array(
          'id' => guvenlik($_POST['kul_id']),
          'sifre' => $kul_sifre
        ));

//dönen satır sayısını belirtir
        $say=$kullanicisor->rowCount();

        if ($say==0) {
          header("Location:../profil?durum=eskisifrehata");
        } else {
//eski şifre doğruysa başla
          if ($yenisifre_bir==$yenisifre_iki) {
           if (strlen($yenisifre_bir)>=1) {
//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
            $sifre=md5($yenisifre_bir);
            $kullanici_yetki=0;
            $kullanicikaydet=$db->prepare("UPDATE kullanicilar SET
             kul_sifre=:kul_sifre
             WHERE kul_id=:kul_id");

            $insert=$kullanicikaydet->execute(array(
             'kul_sifre' => $sifre,
             'kul_id'=>guvenlik($_POST['kul_id'])
           ));

            if ($insert) {
             header("Location:../profil.php?durum=sifredegisti");
           } else {
             header("Location:../profil.php?durum=no");
           }

// Bitiş
         } else {
          header("Location:../profil.php?durum=eksiksifre");
        }

      } else {
       header("Location:../profil?durum=sifreleruyusmuyor");
       exit;
     }
   }
   exit;
   if ($update) {
    header("Location:../profil?durum=ok");

  } else {
    header("Location:../profil?durum=no");
  }
}


/********************************************************************************/


if (isset($_POST['profilguncelle'])) {
  if (yetkikontrol()!="yetkili") {
    header("location:../index.php");
    exit;
  }
  if (isset($_SESSION['kul_mail'])) {
            	$profilguncelle=$db->prepare("UPDATE kullanicilar SET
            		kul_isim=:isim,
            		kul_mail=:mail,
            		kul_telefon=:telefon,
            		kul_unvan=:unvan WHERE session_mail=:session_mail");
            	$ekleme=$profilguncelle->execute(array(
            		'isim' => guvenlik($_POST['kul_isim']),
            		'mail' => guvenlik($_POST['kul_mail']),
            		'telefon' => guvenlik($_POST['kul_telefon']),
            		'unvan' => guvenlik($_POST['kul_unvan']),
            		'session_mail' => $_SESSION['kul_mail']
            	));

            	if ($ekleme) {
            		header("Location:../profil?durum=ok");
            	} else {
            		header("Location:../profil?durum=noff");
            	}
            	exit;
            }
}


/********************************************************************************/


        if (isset($_POST['projesilme'])) {
          if (yetkikontrol()!="yetkili") {
            header("location:../index.php");
            exit;
          }
          $sil=$db->prepare("DELETE from proje where proje_id=:id");
          $kontrol=$sil->execute(array(
            'id' => guvenlik($_POST['proje_id'])
          ));

          if ($kontrol) {
            header("location:../projeler?durum=ok");
            exit;
          } else {
            header("location:../projeler?durum=no");
            exit;

          }
        }

		
/********************************************************************************/
        ?>
