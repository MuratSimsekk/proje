-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 21 Şub 2024, 21:21:51
-- Sunucu sürümü: 10.4.22-MariaDB
-- PHP Sürümü: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `proje`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ID` int(11) NOT NULL,
  `LOGO` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ID`, `LOGO`) VALUES
(4, 0x2e2e2f4c6f676f496d672f6c6f676f2e504e47);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cuzdan`
--

CREATE TABLE `cuzdan` (
  `ID` int(11) NOT NULL,
  `CUZDAN_ISMI` varchar(50) NOT NULL,
  `BAKIYE_TUTAR` int(11) NOT NULL,
  `DOVIZ_TURU` varchar(20) NOT NULL,
  `TLALIS` int(11) NOT NULL,
  `USDALIS` int(11) NOT NULL,
  `EURALIS` int(11) NOT NULL,
  `ALIS_FIYATI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `cuzdan`
--

INSERT INTO `cuzdan` (`ID`, `CUZDAN_ISMI`, `BAKIYE_TUTAR`, `DOVIZ_TURU`, `TLALIS`, `USDALIS`, `EURALIS`, `ALIS_FIYATI`) VALUES
(509, 'Murat', 60, 'EUR', 0, 31, 33, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE `haberler` (
  `ID` int(11) NOT NULL,
  `BASLIK` text NOT NULL,
  `ICERIK` varchar(10000) NOT NULL,
  `KAPAKRESMI` longblob NOT NULL,
  `KATEGORI` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`ID`, `BASLIK`, `ICERIK`, `KAPAKRESMI`, `KATEGORI`) VALUES
(54, 'İşte karşınızda İphone 15', '2013 yılında ilk oyunu, 2020’de ise ikinci oyunu çıkış yapan The Last of Us, son zamanların en başarılı oyun serilerinden biriydi. Bu yıl çıkan HBO imzalı başarılı dizi uyarlaması da oyunun iyice popülerleşmesini sağlamıştı. Geliştirici Naughty Dog, geçtiğimiz yıl hayranların uzun süredir beklediği haberi vermiş ve The Last of Us evreninde geçen ayrı bir multiplayer oyunun geleceğini duyurmuştu. Aslında bu oyunun, geçtiğimiz günlerde düzenlenen PlayStation Showcase etkinliğinde gösterilmesi bekleniyordu; ancak bu yaşanmadı. Oyunseverlerin meraklı bekleyişi sürerken Naughty Dog’tan açıklama geldi. 2013 yılında ilk oyunu, 2020’de ise ikinci oyunu çıkış yapan The Last of Us, son zamanların en başarılı oyun serilerinden biriydi. Bu yıl çıkan HBO imzalı başarılı dizi uyarlaması da oyunun iyice popülerleşmesini sağlamıştı. Geliştirici Naughty Dog, geçtiğimiz yıl hayranların uzun süredir beklediği haberi vermiş ve The Last of Us evreninde geçen ayrı bir multiplayer oyunun geleceğini duyurmuştu. Aslında bu oyunun, geçtiğimiz günlerde düzenlenen PlayStation Showcase etkinliğinde gösterilmesi bekleniyordu; ancak bu yaşanmadı. Oyunseverlerin meraklı bekleyişi sürerken Naughty Dog’tan açıklama geldi....', 0x2e2e2f75706c6f6164732f6d6f62696c312e6a706567, 'MOBİL'),
(78, 'Yapay Zekâ ile Resmettik!', 'asdas', 0x2e2e2f75706c6f6164732f6d6f62696c332e6a706567, 'TEKNOLOJİ'),
(79, 'Yapay Zekâ ile Resmettik!', 'aezsrdxcfgvbhnjkmlöş', 0x2e2e2f75706c6f6164732f6d6f62696c342e6a706567, 'OYUN');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `ID` int(11) NOT NULL,
  `ADSOYAD` text NOT NULL,
  `EPOSTA` text NOT NULL,
  `HAKKINDA` text NOT NULL,
  `KADI` text NOT NULL,
  `SIFRE` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`ID`, `ADSOYAD`, `EPOSTA`, `HAKKINDA`, `KADI`, `SIFRE`) VALUES
(9, 'Murat Şimşek', 'murat_smsk.52@gmail.com', 'asdasd', 'admin', '123');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `ID` int(11) NOT NULL,
  `KUL_ADI` varchar(50) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `SIFRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`ID`, `KUL_ADI`, `EMAIL`, `SIFRE`) VALUES
(9, 'murat', 'asdasdas@gmail.com', '123');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `cuzdan`
--
ALTER TABLE `cuzdan`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ayar`
--
ALTER TABLE `ayar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `cuzdan`
--
ALTER TABLE `cuzdan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
