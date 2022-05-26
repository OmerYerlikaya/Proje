-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 May 2021, 12:38:41
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mysql`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `site_baslik` varchar(300) DEFAULT NULL,
  `site_aciklama` varchar(300) DEFAULT NULL,
  `site_sahibi` varchar(100) DEFAULT NULL,
  `mail_onayi` int(11) DEFAULT NULL,
  `duyuru_onayi` int(11) DEFAULT NULL,
  `site_logo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `site_baslik`, `site_aciklama`, `site_sahibi`, `mail_onayi`, `duyuru_onayi`, `site_logo`) VALUES
(1, 'İnternet Programcılığı', 'Final Projesi', 'Emre Karadeniz', 0, 0, 'img/comu.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `kul_id` int(5) NOT NULL,
  `kul_isim` varchar(200) DEFAULT NULL,
  `kul_mail` varchar(250) DEFAULT NULL,
  `kul_sifre` varchar(250) DEFAULT NULL,
  `kul_telefon` varchar(50) DEFAULT NULL,
  `kul_unvan` varchar(250) DEFAULT NULL,
  `kul_yetki` int(11) DEFAULT NULL,
  `kul_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) DEFAULT NULL,
  `session_mail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`kul_id`, `kul_isim`, `kul_mail`, `kul_sifre`, `kul_telefon`, `kul_unvan`, `kul_yetki`, `kul_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Emre Karadeniz', 'emrekaradeniz@gmail.com', '202cb962ac59075b964b07152d234b70', '5393278535', 'Admin', 1, 'img/comu.png', '::1', 'f547e2adeab5f8a74a39296ac2dde769');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `loglar`
--

CREATE TABLE `loglar` (
  `log_id` int(11) NOT NULL,
  `kul_id` int(11) DEFAULT NULL,
  `ip_adress` varchar(50) DEFAULT NULL,
  `log_tarihi` datetime DEFAULT current_timestamp(),
  `islem` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `loglar`
--

INSERT INTO `loglar` (`log_id`, `kul_id`, `ip_adress`, `log_tarihi`, `islem`) VALUES
(1, 1, '::1', '2021-05-23 13:35:57', 'Çıkış'),
(2, 1, '::1', '2021-05-23 13:36:02', 'Giriş');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `proje`
--

CREATE TABLE `proje` (
  `proje_id` int(5) NOT NULL,
  `personel_grubu` varchar(250) DEFAULT NULL,
  `personel_tc` text DEFAULT NULL,
  `personel_ad` varchar(100) DEFAULT NULL,
  `personel_soyad` varchar(100) DEFAULT NULL,
  `personel_meslek` varchar(500) DEFAULT NULL,
  `personel_mail` varchar(100) DEFAULT NULL,
  `personel_tel` varchar(50) DEFAULT NULL,
  `personel_cinsiyet` varchar(200) DEFAULT NULL,
  `dogum_tarihi` datetime DEFAULT current_timestamp(),
  `kayit_tarihi` datetime DEFAULT current_timestamp(),
  `personel_adres` varchar(50) DEFAULT NULL,
  `personel_hakkinda` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `proje`
--

INSERT INTO `proje` (`proje_id`, `personel_grubu`, `personel_tc`, `personel_ad`, `personel_soyad`, `personel_meslek`, `personel_mail`, `personel_tel`, `personel_cinsiyet`, `dogum_tarihi`, `kayit_tarihi`, `personel_adres`, `personel_hakkinda`) VALUES
(1, 'Web Birimi', '12345678900', 'Emre', 'Karadeniz', 'Yazılımcı', 'emre@gmail.com', '5393278535', 'erkek', '2001-05-28 00:00:00', '2021-05-23 00:00:00', 'Sultangazi/İstanbul', '<p>&ouml;ğrenci</p>\r\n'),
(2, 'Sistem Birimi', '98765432100', '&Ouml;mer', 'Yerlikaya', 'M&uuml;d&uuml;r', '&ouml;mer@gmail.com', '05301234567', 'erkek', '2018-10-10 00:00:00', '2021-05-23 00:00:00', 'Karab&uuml;k', '<p>Tecr&uuml;beli</p>\r\n'),
(3, 'Network Birimi', '12312312312', 'Deneme', 'Test', '&Ouml;ğrenci', 'deneme@gmail.com', '05301231212', 'kadın', '2021-05-04 00:00:00', '2021-05-23 00:00:00', 'İstanbul', '<p>deneme</p>\r\n'),
(4, 'İdari Birim', '3213213212', 'Test', 'Deneme', 'Stajyer', 'stajyer@gmail.com', '5312345678', 'erkek', '2021-04-29 00:00:00', '2021-05-23 00:00:00', '&Ccedil;anakkale', '<p>Stajyer</p>\r\n');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`kul_id`),
  ADD UNIQUE KEY `kul_mail` (`kul_mail`);

--
-- Tablo için indeksler `loglar`
--
ALTER TABLE `loglar`
  ADD KEY `Index 1` (`log_id`),
  ADD KEY `FK_loglar_kullanicilar` (`kul_id`);

--
-- Tablo için indeksler `proje`
--
ALTER TABLE `proje`
  ADD PRIMARY KEY (`proje_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `kul_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `loglar`
--
ALTER TABLE `loglar`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `proje`
--
ALTER TABLE `proje`
  MODIFY `proje_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `loglar`
--
ALTER TABLE `loglar`
  ADD CONSTRAINT `FK_loglar_kullanicilar` FOREIGN KEY (`kul_id`) REFERENCES `kullanicilar` (`kul_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
