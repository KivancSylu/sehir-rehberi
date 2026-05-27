<?php
require_once 'baglanti.php';

try {
    // Daha güvenli kullanım (query yerine prepare)
    $sorgu = $db->prepare("SELECT id, sehir_adi FROM sehirler ORDER BY sehir_adi ASC");
    $sorgu->execute();
    $sehirler = $sorgu->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $hata = "Şehir listesi şu an yüklenemiyor.";
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şehir Rehberi | Keşfetmeye Başla</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="sehir_dizayn.css">
    <link rel="icon" href="/anasayfa.png" type="image/png">
</head>

<body>

    <div class="form-card">
        <header>
            <h2>🏙️ Şehir Rehberi</h2>
            <p>Detaylarını görmek istediğiniz şehri seçin.</p>
        </header>

        <?php if (isset($hata)): ?>
            <div class="alert-error"><?= htmlspecialchars($hata) ?></div>
        <?php else: ?>
            <form action="detay.php" method="GET">

                <div class="input-group">
                    <label for="sehir">İl Listesi</label>

                    <select name="id" id="sehir" required>
                        <option value="" disabled selected>Bir şehir seçiniz...</option>

                        <?php if (!empty($sehirler)): ?>
                            <?php foreach ($sehirler as $sehir): ?>
                                <option value="<?= htmlspecialchars($sehir['id']) ?>">
                                    <?= htmlspecialchars($sehir['sehir_adi']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled>Kayıtlı şehir bulunamadı.</option>
                        <?php endif; ?>

                    </select>
                </div>

                <button type="submit" class="btn-submit">Şehri İncele</button>

            </form>
        <?php endif; ?>
    </div>

</body>

</html>