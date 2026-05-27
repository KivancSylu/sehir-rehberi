<?php
// Veritabanı bağlantısını dahil ediyoruz
require_once 'baglanti.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veritabanından o ID'ye ait tüm bilgileri çekiyoruz
    $sorgu = $db->prepare("SELECT * FROM sehirler WHERE id = ?");
    $sorgu->execute([$id]);
    $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($sonuc) {
        // JavaScript'in okuyabilmesi için veriyi JSON formatına çeviriyoruz
        echo json_encode($sonuc);
    } else {
        echo json_encode(["hata" => "Şehir bulunamadı"]);
    }
}
