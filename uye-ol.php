<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>BGC KARGO - Üye Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
<link rel="icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
</head>
<body style="background: linear-gradient(135deg, #1a1a1a 0%, #b30000 100%); height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-lg" style="border-radius: 20px;">
                    <div class="text-center mb-4">
                        <span style="font-size: 3rem;">🎁</span>
                        <h3 class="fw-bold">Aramıza Katıl</h3>
                    </div>
                    
                    <?php if(@$_GET['durum']=="hata") { echo '<div class="alert alert-danger">Kayıt sırasında bir hata oluştu!</div>'; } ?>

                    <form action="islem.php?durum=kayit" method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Adınız</label>
                                <input type="text" name="ad" class="form-control rounded-pill" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Soyadınız</label>
                                <input type="text" name="soyad" class="form-control rounded-pill" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>E-posta</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-3">
                            <label>Şifre</label>
                            <input type="password" name="sifre" class="form-control rounded-pill" required>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" required>
                            <label class="form-check-label small">KVKK metnini onaylıyorum.</label>
                        </div>
                        <button type="submit" class="btn btn-warning w-100 fw-bold rounded-pill py-2">Kayıt Ol</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="giris.php" class="small text-muted">Zaten üyeyim, Giriş Yap</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 