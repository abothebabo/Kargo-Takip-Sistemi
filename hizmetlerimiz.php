<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hizmetlerimiz - BGC KARGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(90deg, #8B0000 0%, #b30000 50%, #8B0000 100%); border-bottom: 4px solid #d4af37; padding-bottom: 25px; }
        .garland-lights { position: absolute; bottom: -18px; left: 0; width: 100%; height: 30px; background-image: radial-gradient(circle, #ff0 3px, transparent 4px), radial-gradient(circle, #f00 3px, transparent 4px); background-size: 60px 20px; animation: twinkle 2s infinite alternate; pointer-events: none; }
        @keyframes twinkle { 0% { opacity: 0.6; } 100% { opacity: 1; } }
        
        .service-box { transition: 0.3s; border: 2px dashed #e0e0e0; }
        .service-box:hover { border-color: #d4af37; background: #fffdf0; transform: scale(1.02); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">🎁 BGC KARGO</a>
        <div class="ms-auto"><a href="index.php" class="btn btn-outline-light btn-sm">Geri Dön</a></div>
    </div>
    <div class="garland-lights"></div>
</nav>

<div class="container py-4">
    <h2 class="fw-bold text-center mb-5 text-dark">Size Nasıl Yardımcı Olabiliriz?</h2>
    
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card service-box p-4 h-100 text-center border-0 shadow-sm">
                <i class="bi bi-box-seam text-danger display-4 mb-3"></i>
                <h4 class="fw-bold">Bireysel Gönderi</h4>
                <p class="text-muted small">Evinizden alıp sevdiklerinize güvenle teslim ediyoruz. Standart ve ekonomik paketler.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card service-box p-4 h-100 text-center border-0 shadow-sm">
                <i class="bi bi-building text-warning display-4 mb-3"></i>
                <h4 class="fw-bold">Kurumsal Çözümler</h4>
                <p class="text-muted small">E-ticaret siteleri ve şirketler için özel fiyatlandırma ve entegrasyon desteği.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card service-box p-4 h-100 text-center border-0 shadow-sm">
                <i class="bi bi-rocket-takeoff text-primary display-4 mb-3"></i>
                <h4 class="fw-bold">Aynı Gün Teslimat</h4>
                <p class="text-muted small">Acil gönderileriniz için VIP kurye hizmetimiz ile ışık hızında teslimat.</p>
            </div>
        </div>
    </div>
</div>

<footer class="mt-5 py-4 bg-dark text-white text-center">
    <small>&copy; 2025 BGC KARGO Hizmetleri</small>
</footer>
</body>
</html>