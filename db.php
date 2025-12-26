<?php
try {
    $host = "localhost";
    $dbname = "kargo_takip_db";
    $kullanici = "root";
    $sifre = "";

    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $kullanici, $sifre);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı Bağlantı Hatası: " . $e->getMessage());
}