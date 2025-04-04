<?php
/**
 * Konfiguračný súbor pre pripojenie k databáze
 */

// Nastavenia pripojenia k databáze
$host = 'localhost';      // Hostiteľ databázy
$dbname = 'sablona'; // Názov databázy
$username = 'root';       // Používateľské meno (upravte podľa vašich údajov)
$password = '';           // Heslo (upravte podľa vašich údajov)

try {
    // Vytvorenie PDO objektu pre pripojenie k databáze
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    // Nastavenie režimu chýb na výnimky
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Nastavenie režimu načítania na asociatívne pole
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    // V prípade chyby zobrazíme chybovú správu a ukončíme skript
    die("Chyba pripojenia k databáze: " . $e->getMessage());
}
?>