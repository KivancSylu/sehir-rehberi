<?php
require_once 'baglanti.php';

// ID kontrolü (daha güvenli)
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

try {
    $sorgu = $db->prepare("SELECT * FROM sehirler WHERE id = ?");
    $sorgu->execute([$id]);
    $sehir = $sorgu->fetch(PDO::FETCH_ASSOC);

    if (!$sehir) {
        header("Location: index.php");
        exit;
    }
} catch (PDOException $e) {
    die("Bir hata oluştu.");
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($sehir['sehir_adi']) ?> Detayları</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e0eafc, #cfdef3);
            margin: 0;
        }

        .hero {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            padding: 70px 20px;
            text-align: center;
        }

        .hero h1 {
            margin: 0;
            font-size: 2.2rem;
        }

        .container {
            max-width: 800px;
            margin: -50px auto 20px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .info-box {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            font-size: 1.1rem;
        }

        .info-box:last-child {
            border-bottom: none;
        }

        .back-btn {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            background: #3b82f6;
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #1d4ed8;
        }

        p {
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>

<body>

    <div class="hero">
        <h1><?= htmlspecialchars($sehir['sehir_adi']) ?></h1>
        <p>Türkiye'nin Eşsiz Şehirleri</p>
    </div>

    <div class="container">
        <div class="info-box">
            <strong>Plaka Kodu:</strong> <?= htmlspecialchars($sehir['plaka_kodu'] ?? '-') ?>
        </div>

        <div class="info-box">
            <strong>Meşhur Lezzeti:</strong> <?= htmlspecialchars($sehir['meshur_yemek'] ?? '-') ?>
        </div>

        <div class="info-box">
            <strong>Şehir Hakkında:</strong>
            <p><?= nl2br(htmlspecialchars($sehir['kisa_bilgi'] ?? 'Bilgi bulunamadı.')) ?></p>
        </div>

        <a href="index.php" class="back-btn">← Başka Bir Şehir Seç</a>
    </div>

</body>

</html>