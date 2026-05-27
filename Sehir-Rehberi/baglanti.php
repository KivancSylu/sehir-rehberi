<?php
$host      = 'localhost';
$db_adi    = 'VERITABANI_ADINIZ';
$kullanici = 'VERITABANI_KULLANICI_ADINIZ';
$sifre     = 'BU_KISMI_GUVENLIK_ICIN_GIZLEYIN';
try {
    $db = new PDO("mysql:host=$host;dbname=$db_adi;charset=utf8", $kullanici, $sifre);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Veritabanı Bağlantı Hatası: " . $e->getMessage();
    die();
}
