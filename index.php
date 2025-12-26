<?php 
// Hataları gizle (Beyaz ekran yerine sayfa açılsın)
error_reporting(0); 
include 'db.php'; 
session_start(); 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGC KARGO - Yeni Yılınız Kutlu Olsun</title>
    
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/702/702797.png" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* GENEL AYARLAR */
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            background-image: radial-gradient(#dee2e6 1px, transparent 1px);
            background-size: 20px 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR TASARIMI */
        .navbar {
            background: linear-gradient(90deg, #8B0000 0%, #b30000 50%, #8B0000 100%);
            border-bottom: 4px solid #d4af37;
            padding-bottom: 25px;
            position: relative;
            z-index: 1000; /* En üstte */
        }

        /* YILBAŞI IŞIKLARI (Tıklamayı engellemeyecek şekilde ayarlandı) */
        .garland-lights {
            position: absolute;
            bottom: -18px;
            left: 0;
            width: 100%;
            height: 30px;
            background-image: radial-gradient(circle, #ff0 3px, transparent 4px),
                              radial-gradient(circle, #f00 3px, transparent 4px),
                              radial-gradient(circle, #0f0 3px, transparent 4px),
                              radial-gradient(circle, #00f 3px, transparent 4px);
            background-size: 60px 20px;
            background-position: 0 0, 15px 0, 30px 0, 45px 0;
            animation: twinkle 2s infinite alternate;
            pointer-events: none !important; /* KRİTİK: Işıkların arkasındaki butonlara tıklanabilsin */
            z-index: 1001;
        }

        @keyframes twinkle { 0% { opacity: 0.6; } 100% { opacity: 1; } }

        /* MENÜ LİNKLERİ */
        .menu-link {
            text-decoration: none;
            color: #555;
            font-weight: 800;
            font-size: 1.1rem;
            transition: 0.3s;
        }
        .menu-link:hover {
            color: #b30000;
            transform: translateY(-2px);
        }

        /* SORGULAMA KARTI */
        .hero-section {
            padding: 60px 0;
            flex: 1; /* Footer'ı aşağı itmek için */
        }
        .tracking-card {
            background: #ffffff;
            border-radius: 25px;
            padding: 50px;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            border: 3px dashed #d4af37; 
            box-shadow: 0 10px 40px rgba(212, 175, 55, 0.15);
            position: relative;
        }

        /* BUTONLAR */
        .btn-gold { background-color: #d4af37; color: white; font-weight: bold; border: none; padding: 12px 40px; }
        .btn-gold:hover { background-color: #b89628; color: white; }

        /* FOOTER */
        footer {
            background-color: #1a1a1a;
            color: white;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark shadow">
        <div class="container" style="position: relative; z-index: 1050;">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <span style="font-size: 2rem; margin-right: 10px;">🎁</span> 
                <span>BGC KARGO</span>
            </a>
            
            <div class="ms-auto d-flex align-items-center gap-2">
                <span class="text-white me-3 d-none d-md-inline fw-bold small">
                    <?php echo isset($_SESSION['kullanici_ad']) ? "👋 Merhaba, ".$_SESSION['kullanici_ad'] : "🎅 Hoş Geldin 2026"; ?>
                </span>

                <?php if(!isset($_SESSION['kullanici_ad'])): ?>
                    <a href="giris.php" class="btn btn-sm text-white border-0 fw-bold">Giriş Yap</a>
                    <a href="uye-ol.php" class="btn btn-sm btn-light fw-bold text-danger rounded-pill px-4 shadow-sm">Üye Ol</a>
                <?php else: ?>
                    <a href="cikis.php" class="btn btn-sm btn-outline-light rounded-pill">Çıkış Yap</a>
                <?php endif; ?>

                <div class="vr mx-2 bg-white opacity-50" style="height: 25px;"></div>
                <a class="btn btn-outline-warning btn-sm fw-bold shadow-sm" href="kurumsal-secim.php" style="border: 2px solid #ffd700; color: #ffd700;">Kurumsal İşlemler</a>
            </div>
        </div>
        
        <div class="garland-lights"></div>
    </nav>

 <div class="container mt-4 text-center">
    <div class="d-flex justify-content-center gap-5" style="position: relative; z-index: 2000;">
        <a href="hakkimizda.php" class="menu-link">Hakkımızda</a>
        
        <a href="hizmetlerimiz.php" class="menu-link">
            <i class="bi bi-lightbulb-fill text-warning"></i> Hizmetlerimiz
        </a>
        
        <a href="iletisim.php" class="menu-link">Bize Ulaşın</a>
    </div>
</div>

    <div class="hero-section container">
        <div class="tracking-card">
            <h1 class="fw-bold mb-4" style="color: #2c3e50;">
                Kargonuz Nerede? <span style="color: #d4af37;">🦌</span>
            </h1>
            
            <form action="sorgula.php" method="GET" class="position-relative w-100">
    <input type="text" name="takip_no" class="form-control form-control-lg rounded-pill ps-5 py-3 shadow-lg" placeholder="Takip Numaranızı Girin (Örn: BGC123TR)">
    <button type="submit" class="btn btn-danger position-absolute top-50 end-0 translate-middle-y me-2 rounded-pill px-4 fw-bold">
        SORGULA
    </button>
</form>

            <p class="text-muted small mt-3">
                <i class="bi bi-lightbulb text-warning"></i> 2026 yılında da parlak fikirlerle kargonuz güvende!
            </p>
            
            <div style="font-size: 1.5rem; letter-spacing: 15px; margin-top: 20px; opacity: 0.6;">
                🌲🌰🌲🌰🌲
            </div>
        </div>
    </div>

    <footer class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold text-danger">🎁 BGC KARGO</h5>
                    <p class="small text-white-50">Türkiye'nin her yerine güvenli ve hızlı teslimat. Yeni yılda da çözüm ortağınız.</p>
                </div>
                <div class="col-md-4 mb-3 text-center">
                    <h6 class="fw-bold mb-3">Hızlı Menü</h6>
                    <ul class="list-unstyled">
                        <li><a href="hakkimizda.php" class="text-white-50 text-decoration-none small">Hakkımızda</a></li>
                        <li><a href="hizmetlerimiz.php" class="text-white-50 text-decoration-none small">Hizmetlerimiz</a></li>
                        <li><a href="iletisim.php" class="text-white-50 text-decoration-none small">İletişim</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3 text-end">
                    <h6 class="fw-bold mb-3">Bize Ulaşın</h6>
                    <p class="small mb-1 text-white-50"><i class="bi bi-geo-alt text-danger"></i> Viranşehir Yolu, Şanlıurfa</p>
                    <p class="small mb-1 text-white-50"><i class="bi bi-telephone text-danger"></i> 0532 113 14 96</p>
                </div>
            </div>
            <hr class="border-secondary">
            <div class="text-center small text-white-50">
                &copy; 2025 BGC KARGO. Tüm Hakları Saklıdır.
            </div>
        </div>
    </footer>

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
                <p><i class="bi bi-envelope me-3"></i> info@bgckargo.com</p>
                <p><i class="bi bi-phone me-3"></i> 0850 123 45 67</p>
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