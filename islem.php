<?php
ob_start();
session_start();
include 'db.php';

// Hataları arka planda yakala ama ekrana basıp yönlendirmeyi bozma
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ==========================================
// 1. BİREYSEL ÜYE OLMA (DÜZELTİLDİ: 'kayit')
// ==========================================
// Formun gönderdiği ?durum=kayit parametresini yakalıyoruz
if (isset($_GET['durum']) && $_GET['durum'] == "kayit") {
    
    // Formdan gelen 'ad' ve 'soyad' verilerini al
    $ad = $_POST['ad'] ?? '';
    $soyad = $_POST['soyad'] ?? '';
    
    // İkisini birleştirip veritabanındaki 'ad_soyad' formatına getir
    $ad_soyad = trim($ad . " " . $soyad);
    
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    try {
        $kaydet = $db->prepare("INSERT INTO kullanicilar SET ad_soyad=?, email=?, sifre=?");
        $sonuc = $kaydet->execute([$ad_soyad, $email, $sifre]);

        if ($sonuc) {
            // Başarılı! Giriş sayfasına yönlendir
            header("Location: giris.php?durum=kayitbasarili");
            exit();
        } else {
            // Veritabanı hatası değil ama kayıt olmadı
            header("Location: uye-ol.php?durum=basarisiz");
            exit();
        }
    } catch (PDOException $e) {
        // Eğer veritabanı hatası varsa göster
        die("Veritabanı Kayıt Hatası: " . $e->getMessage());
    }
}

// ==========================================
// 2. BİREYSEL GİRİŞ
// ==========================================
if (isset($_GET['durum']) && $_GET['durum'] == "giris") {
    $email = trim($_POST['email']);
    $sifre = trim($_POST['sifre']);

    $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE email = ? AND sifre = ?");
    $sorgu->execute([$email, $sifre]);
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($kullanici) {
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['kullanici_ad'] = $kullanici['ad_soyad'];
        
        header("Location: index.php");
        exit();
    } else {
        header("Location: giris.php?hata=yanlis");
        exit();
    }
}

// ==========================================
// 3. KURUMSAL İŞLEMLER (Önceki kodların aynısı)
// ==========================================

// Kurumsal Kayıt
if (isset($_GET['durum']) && $_GET['durum'] == "kurumsal-kayit") {
    $sirket_adi = $_POST['sirket_adi'];
    $vergi_no = $_POST['vergi_no'];
    $yetkili_ad = $_POST['yetkili_ad'];
    $telefon = $_POST['telefon'];
    $adres = $_POST['adres'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $kaydet = $db->prepare("INSERT INTO kurumlar SET sirket_adi=?, vergi_no=?, yetkili_ad=?, telefon=?, adres=?, email=?, sifre=?");
    $kaydet->execute([$sirket_adi, $vergi_no, $yetkili_ad, $telefon, $adres, $email, $sifre]);
    
    header("Location: kurumsal-giris.php?durum=kayitbasarili");
    exit();
}

// Kurumsal Giriş
if (isset($_GET['durum']) && $_GET['durum'] == "kurumsal-giris") {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $sorgu = $db->prepare("SELECT * FROM kurumlar WHERE email = ? AND sifre = ?");
    $sorgu->execute([$email, $sifre]);
    $kurum = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($kurum) {
        $_SESSION['kurum_id'] = $kurum['id'];
        $_SESSION['kurumsal_ad'] = $kurum['sirket_adi'];
        $_SESSION['kurum_adres'] = $kurum['adres'];
        $_SESSION['kurum_tel'] = $kurum['telefon'];
        header("Location: kurumsal-panel.php");
        exit();
    } else {
        header("Location: kurumsal-giris.php?hata=yanlis");
        exit();
    }
}

// --- KARGO EKLEME VE SMS GÖNDERME ---
if (isset($_GET['durum']) && $_GET['durum'] == "kargo-ekle") {
    $takip_no = $_POST['takip_no'];
    $gonderici = $_POST['gonderici'];
    $gonderici_tel = $_POST['gonderici_tel'];
    $alici = $_POST['alici'];
    $alici_tel = $_POST['alici_tel']; // Yeni alan
    $alici_adres = $_POST['alici_adres'];
    $kurum_id = $_SESSION['kurum_id'];

    // 1. Veritabanına Kaydet
    $kaydet = $db->prepare("INSERT INTO kargolar SET takip_no=?, gonderici=?, gonderici_tel=?, alici=?, alici_tel=?, alici_adres=?, durum='Hazırlanıyor', kurum_id=?");
    $sonuc = $kaydet->execute([$takip_no, $gonderici, $gonderici_tel, $alici, $alici_tel, $alici_adres, $kurum_id]);

    if ($sonuc) {
        // 2. SMS Simülasyonu (Gerçek API buraya yazılır)
        $mesaj = "Sayın $alici, kargonuz kabul edilmiştir. Takip No: $takip_no - BGC KARGO";
        
        // Şimdilik gerçek SMS atmıyoruz ama atmış gibi işlem yapıyoruz.
        // İleride buraya Netgsm veya Twilio kodlarını yapıştıracaksın.
        
        // İşlem tamam, kullanıcıya "SMS Gönderildi" mesajı verelim
        header("Location: kurumsal-panel.php?islem=sms_gonderildi");
        exit();
    } else {
        header("Location: kurumsal-panel.php?islem=hata");
        exit();
    }
}
// Durum Güncelleme
if (isset($_GET['durum']) && $_GET['durum'] == "durum-guncelle") {
    $id = $_POST['kargo_id'];
    $yeni_durum = $_POST['yeni_durum'];
    $guncelle = $db->prepare("UPDATE kargolar SET durum=? WHERE id=?");
    $guncelle->execute([$yeni_durum, $id]);
    header("Location: kurumsal-panel.php");
    exit();
}
?>