<?php
session_start();
include 'db.php';

// Güvenlik: Giriş yapmamışsa at
if (!isset($_SESSION['kurum_id'])) {
    header("Location: kurumsal-giris.php");
    exit();
}

$kurum_id = $_SESSION['kurum_id'];

// --- İSTATİSTİKLER ---
// 1. Toplam Kargo
$sorgu1 = $db->prepare("SELECT COUNT(*) FROM kargolar WHERE kurum_id = ?");
$sorgu1->execute([$kurum_id]);
$toplam_kargo = $sorgu1->fetchColumn();

// 2. Teslim Edilen
$sorgu2 = $db->prepare("SELECT COUNT(*) FROM kargolar WHERE kurum_id = ? AND durum = 'Teslim Edildi'");
$sorgu2->execute([$kurum_id]);
$teslim_edilen = $sorgu2->fetchColumn();

// 3. Yolda Olan
$sorgu3 = $db->prepare("SELECT COUNT(*) FROM kargolar WHERE kurum_id = ? AND durum != 'Teslim Edildi'");
$sorgu3->execute([$kurum_id]);
$yolda = $sorgu3->fetchColumn();

// --- KARGO LİSTESİNİ ÇEK ---
$kargolar = $db->prepare("SELECT * FROM kargolar WHERE kurum_id = ? ORDER BY id DESC");
$kargolar->execute([$kurum_id]);
$liste = $kargolar->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurumsal Panel - BGC KARGO</title>
    
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .bg-gradient-primary { background: linear-gradient(45deg, #0d6efd, #0a58ca); }
        .bg-gradient-success { background: linear-gradient(45deg, #198754, #146c43); }
        .bg-gradient-warning { background: linear-gradient(45deg, #ffc107, #ffca2c); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-building-fill text-warning"></i> <?php echo $_SESSION['kurumsal_ad']; ?> Paneli
        </a>
        <div class="d-flex">
            <a href="cikis.php" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right"></i> Çıkış Yap
            </a>
        </div>
    </div>
</nav>

<div class="container mt-4">

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-gradient-primary h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Toplam Gönderi</h6>
                        <h2 class="fw-bold mb-0"><?php echo $toplam_kargo; ?></h2>
                    </div>
                    <i class="bi bi-box-seam display-4 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-gradient-success h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Teslim Edilen</h6>
                        <h2 class="fw-bold mb-0"><?php echo $teslim_edilen; ?></h2>
                    </div>
                    <i class="bi bi-check-circle display-4 opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-dark bg-gradient-warning h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase mb-1 opacity-75">Yoldaki Kargolar</h6>
                        <h2 class="fw-bold mb-0"><?php echo $yolda; ?></h2>
                    </div>
                    <i class="bi bi-truck display-4 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-primary"><i class="bi bi-plus-circle"></i> Yeni Kargo Girişi</h5>
        </div>
        <div class="card-body">
            <form action="islem.php?durum=kargo-ekle" method="POST">
                <div class="row g-3">
                    
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Takip Numarası</label>
                        <input type="text" name="takip_no" class="form-control bg-light" value="BGC<?php echo rand(10000,99999); ?>TR" readonly>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Gönderici Adı</label>
                        <input type="text" name="gonderici" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Gönderici Tel</label>
                        <input type="text" name="gonderici_tel" class="form-control" placeholder="05..." required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Alıcı Adı</label>
                        <input type="text" name="alici" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-bold text-danger">Alıcı Tel (SMS İçin)</label>
                        <input type="text" name="alici_tel" class="form-control" placeholder="05..." required>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label small fw-bold">Alıcı Adresi</label>
                        <input type="text" name="alici_adres" class="form-control" required>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary px-4 fw-bold">
                            <i class="bi bi-save"></i> Kargoyu Kaydet ve SMS Gönder
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold text-secondary"><i class="bi bi-list-ul"></i> Gönderi Geçmişi</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="kargoTablo" class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Takip No</th>
                            <th>Alıcı</th>
                            <th>Alıcı Tel</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                            <th class="text-end">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($liste as $k): ?>
                        <tr>
                            <td class="fw-bold text-primary"><?php echo $k['takip_no']; ?></td>
                            <td><?php echo $k['alici']; ?></td>
                            <td><?php echo $k['alici_tel']; ?></td>
                            <td>
                                <?php 
                                    $renk = 'secondary';
                                    if($k['durum'] == 'Teslim Edildi') $renk = 'success';
                                    if($k['durum'] == 'Dağıtımda') $renk = 'warning text-dark';
                                    if($k['durum'] == 'Yola Çıktı') $renk = 'info text-dark';
                                ?>
                                <span class="badge bg-<?php echo $renk; ?>"><?php echo $k['durum']; ?></span>
                            </td>
                            <td><?php echo date("d.m.Y H:i", strtotime($k['tarih'])); ?></td>
                            
                            <td class="text-end">
                                <form action="islem.php?durum=durum-guncelle" method="POST" class="d-inline-block me-1">
                                    <input type="hidden" name="kargo_id" value="<?php echo $k['id']; ?>">
                                    <select name="yeni_durum" class="form-select form-select-sm d-inline-block w-auto" onchange="this.form.submit()">
                                        <option selected disabled>Durum Seç</option>
                                        <option value="Yola Çıktı">Yola Çıktı</option>
                                        <option value="Dağıtımda">Dağıtımda</option>
                                        <option value="Teslim Edildi">Teslim Edildi</option>
                                    </select>
                                </form>

                                <a href="yazdir.php?id=<?php echo $k['id']; ?>" target="_blank" class="btn btn-dark btn-sm" title="Fiş Yazdır">
                                    <i class="bi bi-printer-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Tabloyu DataTables'a çevir (Türkçe Yap)
    $(document).ready(function() {
        $('#kargoTablo').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
            },
            order: [[4, 'desc']] // Tarihe göre en yeni en üstte
        });
    });

    // URL'den gelen mesaja göre SweetAlert Bildirimi
    const urlParams = new URLSearchParams(window.location.search);
    const islem = urlParams.get('islem');

    if (islem === 'sms_gonderildi') {
        Swal.fire({
            title: 'Kargo & SMS Başarılı!',
            text: 'Kargo sisteme girildi ve alıcıya bilgilendirme SMS\'i gönderildi.',
            icon: 'success',
            confirmButtonText: 'Harika',
            confirmButtonColor: '#198754'
        });
        // URL'yi temizle
        window.history.replaceState(null, null, window.location.pathname);
    } 
    else if (islem === 'hata') {
        Swal.fire({
            title: 'Hata!',
            text: 'Bir sorun oluştu, lütfen tekrar deneyin.',
            icon: 'error',
            confirmButtonText: 'Tamam'
        });
    }
</script>

</body>
</html>