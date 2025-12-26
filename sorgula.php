<?php
session_start();
include 'db.php';

$kargo = null;
$mesaj = "";

// Eğer arama yapıldıysa veya URL'den takip no geldiyse
if (isset($_GET['takip_no']) || isset($_POST['takip_no'])) {
    // Hangisi doluysa onu al
    $takip_no = $_GET['takip_no'] ?? $_POST['takip_no'];
    $takip_no = trim($takip_no); // Boşlukları temizle

    // Veritabanında ara
    $sorgu = $db->prepare("SELECT k.*, kr.sirket_adi FROM kargolar k LEFT JOIN kurumlar kr ON k.kurum_id = kr.id WHERE k.takip_no = ?");
    $sorgu->execute([$takip_no]);
    $kargo = $sorgu->fetch(PDO::FETCH_ASSOC);

    if (!$kargo) {
        $mesaj = "Bu takip numarasına ait bir gönderi bulunamadı.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kargo Sorgula - BGC KARGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
    
    <style>
        body { background-color: #f8f9fa; }
        .timeline { position: relative; padding: 20px 0; list-style: none; }
        .timeline-item { position: relative; padding-left: 40px; margin-bottom: 20px; }
        .timeline-item::before {
            content: "\F26A"; font-family: "bootstrap-icons";
            position: absolute; left: 0; top: 0; width: 30px; height: 30px;
            background: #e9ecef; color: #6c757d; border-radius: 50%;
            text-align: center; line-height: 30px; font-weight: bold;
        }
        /* Aktif Durum Rengi */
        .active-step::before { background: #198754; color: white; content: "\F26E"; }
        .card { border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-box-seam-fill text-warning"></i> BGC KARGO
        </a>
        <a href="index.php" class="btn btn-outline-light btn-sm">Ana Sayfa</a>
    </div>
</nav>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <div class="card p-4 mb-4">
                <h4 class="fw-bold text-center mb-3">📦 Kargo Takip</h4>
                <form action="sorgula.php" method="GET" class="d-flex gap-2">
                    <input type="text" name="takip_no" class="form-control form-control-lg" placeholder="Takip Numaranız (Örn: BGC123TR)" value="<?php echo $takip_no ?? ''; ?>" required>
                    <button type="submit" class="btn btn-warning btn-lg fw-bold">Sorgula</button>
                </form>
                <?php if($mesaj): ?>
                    <div class="alert alert-danger mt-3"><?php echo $mesaj; ?></div>
                <?php endif; ?>
            </div>

            <?php if ($kargo): ?>
                <div class="card">
                    <div class="card-header bg-success text-white py-3">
                        <h5 class="mb-0 fw-bold"><i class="bi bi-check-circle"></i> Sonuç Bulundu</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <small class="text-muted">Takip Numarası</small>
                                <h4 class="fw-bold text-danger"><?php echo $kargo['takip_no']; ?></h4>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <small class="text-muted">Son Durum</small>
                                <h4 class="fw-bold text-success"><?php echo $kargo['durum']; ?></h4>
                            </div>
                        </div>

                        <hr>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="fw-bold text-muted">Gönderici Acente</small>
                                    <div class="fw-bold"><?php echo $kargo['sirket_adi']; ?></div>
                                    <small class="text-muted"><?php echo $kargo['gonderici']; ?></small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="fw-bold text-muted">Alıcı Bilgileri</small>
                                    <div class="fw-bold"><?php echo $kargo['alici']; ?></div>
                                    <small class="text-muted"><?php echo $kargo['alici_adres']; ?></small>
                                </div>
                            </div>
                        </div>

                        <h6 class="mt-5 fw-bold text-muted">Hareket Geçmişi</h6>
                        <ul class="timeline">
                            <li class="timeline-item <?php echo ($kargo['durum'] == 'Hazırlanıyor' || $kargo['durum'] == 'Yola Çıktı' || $kargo['durum'] == 'Dağıtımda' || $kargo['durum'] == 'Teslim Edildi') ? 'active-step' : ''; ?>">
                                <strong>Sipariş Alındı / Hazırlanıyor</strong>
                                <p class="small text-muted mb-0">Acente kargoyu sisteme girdi.</p>
                            </li>
                            <li class="timeline-item <?php echo ($kargo['durum'] == 'Yola Çıktı' || $kargo['durum'] == 'Dağıtımda' || $kargo['durum'] == 'Teslim Edildi') ? 'active-step' : ''; ?>">
                                <strong>Yola Çıktı</strong>
                                <p class="small text-muted mb-0">Transfer merkezine sevk edildi.</p>
                            </li>
                            <li class="timeline-item <?php echo ($kargo['durum'] == 'Dağıtımda' || $kargo['durum'] == 'Teslim Edildi') ? 'active-step' : ''; ?>">
                                <strong>Dağıtımda</strong>
                                <p class="small text-muted mb-0">Kurye teslimat için yola çıktı.</p>
                            </li>
                            <li class="timeline-item <?php echo ($kargo['durum'] == 'Teslim Edildi') ? 'active-step' : ''; ?>">
                                <strong>Teslim Edildi</strong>
                                <p class="small text-muted mb-0">Alıcıya teslim edildi.</p>
                            </li>
                        </ul>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

</body>
<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">BGC KARGO</h5>
                <p>Türkiye'nin 81 iline güvenli, hızlı ve teknolojik taşımacılık hizmeti sunuyoruz. Kargonuz bizimle güvende.</p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Hızlı Erişim</h5>
                <p><a href="index.php" class="text-white text-decoration-none">Ana Sayfa</a></p>
                <p><a href="sorgula.php" class="text-white text-decoration-none">Kargo Sorgula</a></p>
                <p><a href="kurumsal-giris.php" class="text-white text-decoration-none">Acente Girişi</a></p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-warning">İletişim</h5>
                <p><i class="bi bi-house-door me-3"></i> Viranşehir, Şanlıurfa, TR</p>
                <p><i class="bi bi-envelope me-3"></i> abdulhamidgeylanib@gmail.com</p>
                <p><i class="bi bi-phone me-3"></i> 0532 113 14 96</p>
            </div>
        </div>

        <hr class="mb-4">

        <div class="row align-items-center">
            <div class="col-md-7 col-lg-8">
                <p>© 2024 Tüm Hakları Saklıdır: 
                    <a href="#" class="text-warning text-decoration-none"><strong>BGC Yazılım A.Ş.</strong></a>
                </p>
            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-end">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px;"><i class="bi bi-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
</html>