<?php
// 1. Tüm Hataları Zorla Aç
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>🔍 Sistem Kontrolü Başladı</h1><hr>";

// 2. db.php Dosyası Var mı?
echo "<strong>Adım 1:</strong> db.php dosyası aranıyor... ";
if (file_exists('db.php')) {
    echo "<span style='color:green'>MEVCUT ✅</span><br>";
    
    // Dosyayı dahil et
    require 'db.php';
    echo "<strong>Adım 2:</strong> db.php başarıyla dahil edildi. <span style='color:green'>BAŞARILI ✅</span><br>";
} else {
    die("<span style='color:red'>HATA: db.php dosyası bulunamadı! Lütfen dosya adını kontrol edin. ❌</span>");
}

// 3. Veritabanı Bağlantısı Testi
echo "<strong>Adım 3:</strong> Veritabanı bağlantısı kontrol ediliyor... ";
if (isset($db)) {
    echo "<span style='color:green'>BAĞLANTI AÇIK ✅</span><br>";
} else {
    die("<span style='color:red'>HATA: \$db değişkeni yok! db.php içindeki kodları kontrol edin. ❌</span>");
}

// 4. Tablo Kontrolü
echo "<strong>Adım 4:</strong> 'kullanicilar' tablosu aranıyor... ";
try {
    $test = $db->query("SELECT count(*) FROM kullanicilar");
    echo "<span style='color:green'>TABLO BULUNDU ✅</span><br>";
} catch (PDOException $e) {
    echo "<br><span style='color:red'>KRİTİK HATA: Tablo Bulunamadı!</span><br>";
    echo "Hata Mesajı: " . $e->getMessage() . "<br>";
    echo "Çözüm: PhpMyAdmin'den 'kullanicilar' tablosunu oluşturmalısınız.";
    exit;
}

// 5. Oturum Testi
echo "<strong>Adım 5:</strong> Oturum (Session) testi... ";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION['test'] = 'calisiyor';
if (isset($_SESSION['test'])) {
    echo "<span style='color:green'>SESSION ÇALIŞIYOR ✅</span><br>";
} else {
    echo "<span style='color:red'>SESSION HATASI ❌</span><br>";
}

echo "<hr><h3>🎉 TEBRİKLER! Altyapıda hiçbir sorun yok.</h3>";
echo "Eğer buraya kadar hepsi YEŞİL ise, sorun 'islem.php' dosyasındaki bir yazım hatasındadır.";
?>