<?php
// Oturumu başlat
session_start();

// Eğer kullanıcı zaten giriş yapmışsa tekrar giriş sayfasına girmesin, ana sayfaya gitsin
if (isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bireysel Giriş - BGC KARGO</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(90deg, #8B0000 0%, #b30000 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #b30000;
        }
        .btn-custom {
            background-color: #b30000;
            color: white;
            padding: 12px;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #8B0000;
            color: white;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            
            <div class="text-center mb-4">
                <a href="index.php" class="btn btn-outline-secondary btn-sm rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Ana Sayfaya Dön
                </a>
            </div>

            <div class="card login-card">
                <div class="card-header">
                    <h3 class="fw-bold mb-0">🎁 Bireysel Giriş</h3>
                    <p class="small opacity-75 mb-0">Kargonuzu takip etmek için giriş yapın</p>
                </div>
                <div class="card-body p-4">

                    <?php if (isset($_GET['hata']) && $_GET['hata'] == 'yanlis'): ?>
                        <div class="alert alert-danger text-center small fade show">
                            <i class="bi bi-exclamation-circle-fill"></i> E-posta veya şifre hatalı!
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_GET['durum']) && $_GET['durum'] == 'kayitbasarili'): ?>
                        <div class="alert alert-success text-center small fade show">
                            <i class="bi bi-check-circle-fill"></i> Kayıt başarılı! Lütfen giriş yapın.
                        </div>
                    <?php endif; ?>

                    <form action="islem.php?durum=giris" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">E-posta Adresi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control bg-light border-start-0" placeholder="ornek@email.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Şifre</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                                <input type="password" name="sifre" class="form-control bg-light border-start-0" placeholder="******" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom w-100 rounded-3">Giriş Yap</button>

                    </form>

                    <div class="text-center mt-4">
                        <p class="small text-muted mb-2">Hesabınız yok mu?</p>
                        <a href="uye-ol.php" class="text-danger fw-bold text-decoration-none">Hemen Üye Ol</a>
                    </div>
                    
                    <hr class="my-4 opacity-25">
                    
                    <div class="text-center">
                        <a href="kurumsal-giris.php" class="small text-secondary text-decoration-none">
                            <i class="bi bi-building"></i> Kurumsal Giriş (Acente)
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>