<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>BGC KARGO - Kurumsal Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
    <style>
        body { background: linear-gradient(135deg, #1e272e 0%, #2f3542 100%); min-height: 100vh; display: flex; align-items: center; padding: 20px 0; font-family: sans-serif; }
        .kurumsal-container { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.3); width: 100%; max-width: 1000px; margin: auto; }
        .info-section { background: #b30000; color: white; padding: 40px; }
        .login-section { padding: 40px; background: #ffffff; }
        .btn-kurumsal { background: #b30000; color: white; border-radius: 50px; transition: 0.3s; border: none; padding: 12px; }
        .btn-kurumsal:hover { background: #d4af37; color: white; }
        .contact-item { margin-bottom: 20px; display: flex; align-items: flex-start; }
        .contact-icon { font-size: 1.5rem; margin-right: 15px; }
    </style>
</head>
<body>

<div class="container">
    <div class="kurumsal-container">
        <div class="row g-0">
            <div class="col-md-6 info-section">
                <h2 class="fw-bold mb-4">BGC KARGO KURUMSAL</h2>
                <p class="mb-5 opacity-75">İş ortaklarımıza özel lojistik çözümler ve avantajlı fiyatlarla 2026'da da yanınızdayız.</p>
                
                <div class="contact-item">
                    <span class="contact-icon">📍</span>
                    <div>
                        <h6 class="fw-bold mb-0">Genel Merkez (Yer)</h6>
                        <p class="small mb-0">Viranşehir Yolu Üzeri, BGC Plaza No:126, Şanlıurfa / Türkiye</p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <div>
                        <h6 class="fw-bold mb-0">Kurumsal Destek Hattı</h6>
                        <p class="small mb-0">0532 113 14 96</p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="contact-icon">✉️</span>
                    <div>
                        <h6 class="fw-bold mb-0">E-posta Adresi</h6>
                        <p class="small mb-0">kurumsal@bgckargo.com</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 login-section">
                <div class="text-center mb-5">
                    <h3 class="fw-bold">Kurumsal Giriş</h3>
                    <p class="text-muted small">Hesabınıza erişmek için bilgilerinizi girin.</p>
                    
                    <?php if(isset($_GET['kayit']) && $_GET['kayit']=="basarili"): ?>
                        <div class="alert alert-success py-2 small">Kaydınız başarıyla oluşturuldu!</div>
                    <?php endif; ?>
                </div>

             <form action="islem.php?durum=kurumsal-giris" method="POST">
    
    <div class="mb-3">
        <label class="form-label small fw-bold">Kurum E-posta</label>
        <input type="email" name="email" class="form-control" required placeholder="kurum@sirket.com">
    </div>

    <div class="mb-3">
        <label class="form-label small fw-bold">Şifre</label>
        <input type="password" name="sifre" class="form-control" required placeholder="********">
    </div>

    <button type="submit" class="btn btn-danger w-100 fw-bold">Giriş Yap</button>
    
    <div class="text-center mt-3">
        <a href="index.php" class="text-decoration-none text-muted small">Ana Sayfaya Dön</a>
    </div>
</form>
            </div>
        </div>
    </div>
</div>

</body>
</html>