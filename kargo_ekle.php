<?php
include 'db.php';

// Form verileri için dropdownları doldur
$musteriler = $pdo->query("SELECT * FROM Musteriler")->fetchAll();
$subeler = $pdo->query("SELECT * FROM Subeler")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gonderici = $_POST['gonderici'];
    $alici = $_POST['alici'];
    $cikis = $_POST['cikis'];
    $varis = $_POST['varis'];
    $ucret = $_POST['ucret'];

    // Stored Procedure Çağırma (Transaction içerir)
    try {
        $sql = "CALL KargoEkle(?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$gonderici, $alici, $cikis, $varis, $ucret]);
        
        $success = "Kargo başarıyla oluşturuldu ve sisteme işlendi.";
    } catch (PDOException $e) {
        $error = "Hata: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kargo Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card col-md-8 mx-auto">
            <div class="card-header">Yeni Kargo Girişi</div>
            <div class="card-body">
                <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
                <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
                
                <form method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Gönderici Müşteri</label>
                            <select name="gonderici" class="form-select">
                                <?php foreach($musteriler as $m) echo "<option value='{$m['MusteriID']}'>{$m['AdSoyad']}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alıcı Müşteri</label>
                            <select name="alici" class="form-select">
                                <?php foreach($musteriler as $m) echo "<option value='{$m['MusteriID']}'>{$m['AdSoyad']}</option>"; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Çıkış Şubesi</label>
                            <select name="cikis" class="form-select">
                                <?php foreach($subeler as $s) echo "<option value='{$s['SubeID']}'>{$s['SubeAdi']}</option>"; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Varış Şubesi</label>
                            <select name="varis" class="form-select">
                                <?php foreach($subeler as $s) echo "<option value='{$s['SubeID']}'>{$s['SubeAdi']}</option>"; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Ücret (TL)</label>
                        <input type="number" step="0.01" name="ucret" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Kargo Oluştur (Transaction)</button>
                    <a href="admin.php" class="btn btn-secondary">İptal</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>