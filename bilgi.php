<?php 
$sayfa = $_GET['sayfa'] ?? 'hakkimizda'; 

// Profesyonel İçerik Yönetimi
$icerik_verisi = [
    'hakkimizda' => [
        'baslik' => 'Geleceği Taşıyoruz',
        'alt_baslik' => 'BGC Kargo Hakkında',
        'metin' => '2025 yılı sonunda temelleri atılan BGC Kargo, kargo sektöründe "Parlak Fikirler, Işık Hızında Teslimat" mottosuyla devrim yapmayı hedeflemektedir. 2026 vizyonumuzla, dijitalleşen dünyada en güvenilir lojistik partneriniz olmayı sürdürüyoruz.',
        'ikon' => '🚀',
        'renk' => '#b30000'
    ],
    'hizmetlerimiz' => [
        'baslik' => 'Size Özel Çözümler',
        'alt_baslik' => 'Neler Sunuyoruz?',
        'metin' => 'Işık Hızıyla Teslimat, Randevulu Alım, SMS Bilgilendirme ve VIP Kargo seçeneklerimizle gönderilerinizi kişiselleştiriyoruz. Her koli, bizim için bir emanettir.',
        'ikon' => '📦',
        'renk' => '#2c3e50'
    ],
    'bize-ulasin' => [
        'baslik' => 'Her Zaman Yanınızdayız',
        'alt_baslik' => 'İletişim Kanallarımız',
        'metin' => 'Sorularınız, önerileriniz veya şikayetleriniz için 7/24 hizmet veren çağrı merkezimizle iletişime geçebilirsiniz. Size bir telefon kadar yakınız.',
        'ikon' => '📞',
        'renk' => '#d4af37'
    ]
];

$data = $icerik_verisi[$sayfa] ?? $icerik_verisi['hakkimizda'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>BGC KARGO | <?php echo $data['alt_baslik']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, <?php echo $data['renk']; ?> 0%, #1a1a1a 100%);
            color: white;
            padding: 80px 0;
            border-bottom-left-radius: 50% 20px;
            border-bottom-right-radius: 50% 20px;
        }
        .content-card {
            margin-top: -50px;
            border: none;
            border-radius: 25px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        .icon-box {
            width: 80px;
            height: 80px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            font-size: 2.5rem;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .btn-return {
            background-color: <?php echo $data['renk']; ?>;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            transition: transform 0.2s;
        }
        .btn-return:hover {
            transform: scale(1.05);
            color: white;
            opacity: 0.9;
        }
    </style>
</head>
<body style="background-color: #f4f7f6;">

    <header class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold"><?php echo $data['baslik']; ?></h1>
            <p class="lead opacity-75">BGC Kargo | 2026 Vizyonu</p>
        </div>
    </header>

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-7">
                <div class="card content-card p-5 text-center">
                    <div class="icon-box">
                        <?php echo $data['ikon']; ?>
                    </div>
                    <h2 class="fw-bold mb-4" style="color: #2c3e50;"><?php echo $data['alt_baslik']; ?></h2>
                    <p class="text-muted fs-5 lh-lg mb-5">
                        <?php echo $data['metin']; ?>
                    </p>
                    
                    <?php if($sayfa == 'bize-ulasin'): ?>
                        <div class="alert alert-light border mb-5">
                            <strong>Müşteri Hattı:</strong> +90 (532) 113 14 96<br>
                            <strong>E-posta:</strong> abdulhamidgeylanib@icloud.com
                        </div>
                    <?php endif; ?>

                    <div>
                        <a href="index.php" class="btn btn-return shadow-sm">
                            ← Ana Sayfaya Dön
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center text-muted mt-5 pb-4">
        <small>© 2026 BGC Kargo Taşımacılık A.Ş.</small>
    </footer>

</body>
</html>