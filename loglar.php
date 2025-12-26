<?php 
include 'db.php'; 
$logs = $pdo->query("SELECT * FROM SistemLoglari ORDER BY IslemTarihi DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sistem Logları</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3>Sistem Logları (Trigger Kayıtları)</h3>
        <a href="admin.php" class="btn btn-secondary mb-3">Panele Dön</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Log ID</th>
                    <th>Tablo</th>
                    <th>İşlem</th>
                    <th>Tarih</th>
                    <th>Detay</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= $log['LogID'] ?></td>
                    <td><?= $log['TabloAdi'] ?></td>
                    <td><span class="badge bg-warning text-dark"><?= $log['IslemTuru'] ?></span></td>
                    <td><?= $log['IslemTarihi'] ?></td>
                    <td><?= $log['Detay'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>