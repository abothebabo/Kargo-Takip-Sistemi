<?php 
include 'db.php'; 

$kargo = null;
$hareketler = [];

if (isset($_GET['takip_no'])) {
    $takipNo = $_GET['takip_no'];

    // View Kullanımı
    $stmt = $pdo->prepare("SELECT * FROM View_KargoTakipDetay WHERE TakipNo = ?");
    $stmt->execute([$takipNo]);
    $kargo = $stmt->fetch();

    // Hareketleri Çekme
    $hStmt = $pdo->prepare("SELECT h.*, s.SubeAdi FROM KargoHareketleri h JOIN Subeler s ON h.IslemSubeID = s.SubeID WHERE TakipNo = ? ORDER BY IslemTarihi DESC");
    $hStmt->execute([$takipNo]);
    $hareketler = $hStmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
<link rel="icon" href="favicon.png" type="image/x-icon">
    <meta charset="UTF-8">
    <title>Kargo Detayı</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Geri Dön</a>
        
        <?php if ($kargo): ?>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Takip No: <?= $kargo['TakipNo'] ?></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Gönderici:</strong> <?= $kargo['Gonderici'] ?></p>
                            <p><strong>Alıcı:</strong> <?= $kargo['Alici'] ?></p>
                            <p><strong>Çıkış Şubesi:</strong> <?= $kargo['CikisSubesi'] ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Varış Şubesi:</strong> <?= $kargo['VarisSubesi'] ?></p>
                            <p><strong>Son Durum:</strong> <span class="badge bg-success"><?= $kargo['Durum'] ?></span></p>
                            <p><strong>Tarih:</strong> <?= $kargo['GonderimTarihi'] ?></p>
                        </div>
                    </div>
                    
                    <h5 class="mt-4">Hareket Geçmişi</h5>
                    <table class="table table-striped mt-2">
                        <thead>
                            <tr>
                                <th>Tarih</th>
                                <th>Şube</th>
                                <th>İşlem</th>
                                <th>Açıklama</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hareketler as $h): ?>
                            <tr>
                                <td><?= $h['IslemTarihi'] ?></td>
                                <td><?= $h['SubeAdi'] ?></td>
                                <td><?= $h['IslemTuru'] ?></td>
                                <td><?= $h['Aciklama'] ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Kayıt bulunamadı. Lütfen takip numaranızı kontrol ediniz.</div>
        <?php endif; ?>
    </div>
</body>
</html>