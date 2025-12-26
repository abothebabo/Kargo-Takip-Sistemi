<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kurumsal Kayıt - BGC KARGO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white text-center p-4">
                    <h3 class="fw-bold mb-0">🏢 Kurumsal Başvuru</h3>
                    <p class="small opacity-75 mb-0">BGC Kargo Acentesi Olun</p>
                </div>
                <div class="card-body p-5">
                    
                    <?php if(isset($_GET['durum']) && $_GET['durum']=="basarisiz"): ?>
                        <div class="alert alert-danger">Kayıt yapılamadı! Lütfen bilgileri kontrol edin.</div>
                    <?php endif; ?>

                    <form action="islem.php?durum=kurumsal-kayit" method="POST">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="fw-bold small">Şirket Adı</label>
                                <input type="text" name="sirket_adi" class="form-control" required placeholder="Örn: BGC Lojistik">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small">Vergi No</label>
                                <input type="text" name="vergi_no" class="form-control" required placeholder="10 haneli no">
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small">Yetkili Adı Soyadı</label>
                                <input type="text" name="yetkili_ad" class="form-control" required placeholder="Ad Soyad">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="fw-bold small">Telefon</label>
                                <input type="text" name="telefon" class="form-control" required placeholder="05XX...">
                            </div>

                            <div class="col-12">
                                <label class="fw-bold small">Şirket Adresi</label>
                                <textarea name="adres" class="form-control" rows="2" required placeholder="Tam adres..."></textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="fw-bold small">E-posta</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold small">Şifre</label>
                                <input type="password" name="sifre" class="form-control" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 fw-bold mt-4 py-2">Kaydı Tamamla</button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="kurumsal-giris.php" class="text-decoration-none text-muted small">Zaten hesabınız var mı? Giriş Yap</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>