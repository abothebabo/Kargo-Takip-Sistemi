<?php 
include 'db.php'; 
// Tüm kargoları listele
$kargolar = $pdo->query("SELECT * FROM View_KargoTakipDetay ORDER BY GonderimTarihi DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<link rel="icon" href="favicon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <title>Yönetim Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Personel Paneli</span>
            <div>
                <a href="kargo_ekle.php" class="btn btn-success btn-sm">+ Yeni Kargo Ekle</a>
                <a href="loglar.php" class="btn btn-warning btn-sm">Sistem Logları</a>
                <a href="index.php" class="btn btn-outline-light btn-sm">Çıkış</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>Kargo Listesi</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Takip No</th>
                    <th>Gönderici</th>
                    <th>Alıcı</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kargolar as $k): ?>
                <tr>
                    <td><?= $k['TakipNo'] ?></td>
                    <td><?= $k['Gonderici'] ?></td>
                    <td><?= $k['Alici'] ?></td>
                    <td><?= $k['Durum'] ?></td>
                    <td>
                        <a href="kargo_guncelle.php?no=<?= $k['TakipNo'] ?>" class="btn btn-primary btn-sm">Güncelle</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>