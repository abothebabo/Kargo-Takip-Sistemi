<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hakkımızda - BGC KARGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        /* Ana Tema CSS'leri */
        body { font-family: 'Nunito', sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(90deg, #8B0000 0%, #b30000 50%, #8B0000 100%); border-bottom: 4px solid #d4af37; padding-bottom: 25px; }
        .garland-lights { position: absolute; bottom: -18px; left: 0; width: 100%; height: 30px; background-image: radial-gradient(circle, #ff0 3px, transparent 4px), radial-gradient(circle, #f00 3px, transparent 4px); background-size: 60px 20px; animation: twinkle 2s infinite alternate; pointer-events: none; }
        @keyframes twinkle { 0% { opacity: 0.6; } 100% { opacity: 1; } }
        
        /* Hakkımızda Özel */
        .mission-card { background: white; border-radius: 15px; border-left: 5px solid #b30000; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: 100%; transition: 0.3s; }
        .mission-card:hover { transform: translateY(-5px); }
        .vision-card { background: white; border-radius: 15px; border-left: 5px solid #d4af37; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); height: 100%; transition: 0.3s; }
        .vision-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php"><span style="font-size: 1.5rem;">🎁</span> BGC KARGO</a>
        <div class="ms-auto"><a href="index.php" class="btn btn-outline-light btn-sm">Ana Sayfaya Dön</a></div>
    </div>
    <div class="garland-lights"></div>
</nav>

<div class="container py-4">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">Biz Kimiz?</h1>
        <p class="lead text-muted">Viranşehir'den Dünyaya Açılan Kapınız</p>
    </div>

    <div class="row g-4">
        <div class="col-12 mb-4">
            <div class="bg-white p-5 rounded-4 shadow-sm">
                <h3 class="fw-bold mb-3">🏢 Kuruluş Hikayemiz</h3>
                <p>BGC Kargo, lojistik sektöründe güven ve hızı birleştirmek amacıyla Şanlıurfa Viranşehir'de kurulmuştur. Yerel bir girişim olarak başladığımız bu yolda, bugün teknolojiyi en iyi kullanan, müşteri memnuniyetini esas alan ve 2026 hedeflerine emin adımlarla yürüyen yenilikçi bir kargo şirketiyiz.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mission-card">
                <div class="fs-1 mb-3">🚀</div>
                <h3 class="fw-bold mb-3">Misyonumuz</h3>
                <p class="text-muted">Müşterilerimizin gönderilerini en hızlı, en güvenli ve en ekonomik şekilde ulaştırarak, lojistik süreçlerini kolaylaştırmak. Teknolojik altyapımızla şeffaf bir kargo takibi sunmak ve bölgenin ticaret hacmine katkıda bulunmaktır.</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="vision-card">
                <div class="fs-1 mb-3">🌟</div>
                <h3 class="fw-bold mb-3">Vizyonumuz</h3>
                <p class="text-muted">2026 yılına kadar Türkiye'nin en çok tercih edilen ve güvenilen yeni nesil kargo şirketi olmak. Sadece bir taşıyıcı değil, aynı zamanda müşterilerimizin çözüm ortağı olarak sektörde standartları belirleyen lider marka haline gelmektir.</p>
            </div>
        </div>
    </div>
</div>

<footer class="mt-5 py-4 bg-dark text-white text-center">
    <small>&copy; 2025 BGC KARGO - Tüm Hakları Saklıdır.</small>
</footer>

</body>
</html>