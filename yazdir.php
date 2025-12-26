<?php
include 'db.php';
session_start();

if (!isset($_GET['id'])) die("Kargo ID girilmedi.");
$id = $_GET['id'];

// Kargoyu bul
$sorgu = $db->prepare("SELECT * FROM kargolar WHERE id = ?");
$sorgu->execute([$id]);
$kargo = $sorgu->fetch(PDO::FETCH_ASSOC);

if (!$kargo) die("Kargo bulunamadı.");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kargo Fişi - <?php echo $kargo['takip_no']; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 400px; margin: 20px auto; border: 2px dashed #333; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 10px; }
        .barkod { text-align: center; margin: 20px 0; }
        .bilgi { margin-bottom: 10px; font-size: 14px; }
        .label { font-weight: bold; display: block; }
        .footer { text-align: center; font-size: 12px; margin-top: 20px; border-top: 1px solid #000; padding-top: 5px; }
        @media print {
            body { border: none; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="header">
        <h2>BGC KARGO</h2>
        <p>Transfer Merkezi Fişi</p>
    </div>

    <div class="barkod">
        <img src="https://barcode.tec-it.com/barcode.ashx?data=<?php echo $kargo['takip_no']; ?>&code=Code128&dpi=96" alt="Barkod">
        <br>
        <strong><?php echo $kargo['takip_no']; ?></strong>
    </div>

    <div class="bilgi">
        <span class="label">GÖNDERİCİ:</span>
        <?php echo $kargo['gonderici']; ?> (<?php echo $kargo['gonderici_tel']; ?>)
    </div>

    <div class="bilgi">
        <span class="label">ALICI:</span>
        <?php echo $kargo['alici']; ?> (<?php echo $kargo['alici_tel']; ?>)
    </div>

    <div class="bilgi">
        <span class="label">ADRES:</span>
        <?php echo $kargo['alici_adres']; ?>
    </div>

    <div class="bilgi">
        <span class="label">TARİH:</span>
        <?php echo date("d.m.Y H:i", strtotime($kargo['tarih'])); ?>
    </div>

    <div class="footer">
        www.bgckargo.com | 0532 113 14 96
    </div>

    <button onclick="window.print()" class="no-print" style="width: 100%; padding: 10px; background: black; color: white; cursor: pointer; margin-top: 20px;">YAZDIR</button>

</body>
</html>