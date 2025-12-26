<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>BGC KARGO - Kurumsal Seçim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
    <style>
        body { background: linear-gradient(135deg, #b30000 0%, #1a1a1a 100%); height: 100vh; display: flex; align-items: center; color: white; }
        .selection-card { background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; transition: 0.3s; cursor: pointer; text-decoration: none; color: white; display: block; padding: 40px; }
        .selection-card:hover { background: rgba(255, 255, 255, 0.2); transform: translateY(-10px); border-color: #d4af37; }
        .icon-box { font-size: 4rem; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1 class="fw-bold mb-2">Kurumsal İş Ortağımız mısınız?</h1>
        <p class="mb-5 opacity-75">Lütfen yapmak istediğiniz işlemi seçiniz.</p>
        
        <div class="row justify-content-center gap-4">
            <div class="col-md-4">
                <a href="kurumsal-giris.php" class="selection-card">
                    <div class="icon-box">🔑</div>
                    <h3 class="fw-bold">Kurumsal Giriş</h3>
                    <p class="small mb-0">Mevcut acente veya kurum hesabınızla sisteme erişin.</p>
                </a>
            </div>

            <div class="col-md-4">
                <a href="kurumsal-kayit.php" class="selection-card">
                    <div class="icon-box">📝</div>
                    <h3 class="fw-bold">Kurumsal Kayıt</h3>
                    <p class="small mb-0">BGC Kargo ailesine katılmak için kurumsal başvurunuzu yapın.</p>
                </a>
            </div>
        </div>

        <div class="mt-5">
            <a href="index.php" class="btn btn-outline-light rounded-pill px-4">Ana Sayfaya Dön</a>
        </div>
    </div>
</body>
</html>