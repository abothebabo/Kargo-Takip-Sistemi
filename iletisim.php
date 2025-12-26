<?php include 'db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İletişim - BGC KARGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Nunito', sans-serif; background-color: #f8f9fa; }
        .navbar { background: linear-gradient(90deg, #8B0000 0%, #b30000 50%, #8B0000 100%); border-bottom: 4px solid #d4af37; padding-bottom: 25px; }
        .garland-lights { position: absolute; bottom: -18px; left: 0; width: 100%; height: 30px; background-image: radial-gradient(circle, #ff0 3px, transparent 4px), radial-gradient(circle, #f00 3px, transparent 4px); background-size: 60px 20px; animation: twinkle 2s infinite alternate; pointer-events: none; }
        @keyframes twinkle { 0% { opacity: 0.6; } 100% { opacity: 1; } }
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
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-5 bg-dark text-white p-5 d-flex flex-column justify-content-center">
                        <h4 class="fw-bold mb-4">İletişim Bilgileri</h4>
                        <p class="mb-3">📍 Viranşehir Yolu Üzeri, BGC Plaza No:126, Şanlıurfa</p>
                        <p class="mb-3">📞 0532 113 14 96</p>
                        <p class="mb-3">✉️ abdulhamidgeylanib@icloud.com</p>
                        <div class="mt-4 pt-4 border-top border-secondary">
                            <small class="text-white-50">Çalışma Saatleri:</small><br>
                            <strong>09:00 - 18:00</strong>
                        </div>
                    </div>
                    <div class="col-md-7 p-5 bg-white">
                        <h3 class="fw-bold mb-4 text-danger">Bize Yazın</h3>
                        <form>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Adınız Soyadınız</label>
                                <input type="text" class="form-control bg-light border-0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">E-posta Adresiniz</label>
                                <input type="email" class="form-control bg-light border-0" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Mesajınız</label>
                                <textarea class="form-control bg-light border-0" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100 fw-bold text-white">Mesaj Gönder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>