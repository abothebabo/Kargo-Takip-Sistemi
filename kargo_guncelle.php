<?php
include 'db.php';

$takipNo = $_GET['no'] ?? '';
$mesaj = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $yeniDurum = $_POST['durum'];
    $takipNo = $_POST['takip_no'];
    
    // Güncelleme işlemi (Bu işlem Trigger'ı tetikler ve Log tablosuna yazar)
    $stmt = $pdo->prepare("UPDATE Kargolar SET Durum = ? WHERE TakipNo = ?");
    $stmt->execute([$yeniDurum, $takipNo]);

    // Ayrıca hareket tablosuna da ekleyelim
    $pdo->prepare("INSERT INTO KargoHareketleri (TakipNo, IslemSubeID, IslemTuru, Aciklama) VALUES (?, 1, 'Güncelleme', ?)")
        ->execute([$takipNo, "Durum $yeniDurum olarak güncellendi."]);

    $mesaj = "Güncelleme Başarılı! Log kaydı oluşturuldu.";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kargo Güncelle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card col-md-6 mx-auto">
            <div class="card-header">Kargo Durum Güncelleme</div>
            <div class="card-body">
                <?php if($mesaj) echo "<div class='alert alert-success'>$mesaj</div>"; ?>
                
                <form method="POST">
                    <input type="hidden" name="takip_no" value="<?= $takipNo ?>">
                    <div class="mb-3">
                        <label>Takip No: <strong><?= $takipNo ?></strong></label>
                    </div>
                    <div class="mb-3">
                        <label>Yeni Durum</label>
                        <select name="durum" class="form-select">
                            <option>Transfer Aşamasında</option>
                            <option>Dağıtıma Çıktı</option>
                            <option>Teslim Edildi</option>
                            <option>İade</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Güncelle</button>
                    <a href="admin.php" class="btn btn-secondary">Geri Dön</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>