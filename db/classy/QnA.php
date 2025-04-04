<?php
/**
 * Trieda QnA - slúži na správu otázok a odpovedí
 * Obsahuje metódy na vkladanie a čítanie otázok z databázy
 */
class QnA {
    private $conn;
    
    /**
     * Konštruktor triedy, inicializuje pripojenie k databáze
     * @param PDO $dbConnection Pripojenie k databáze
     */
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }
    
    /**
     * Metóda na čítanie všetkých otázok a odpovedí z databázy
     * @return array Pole otázok a odpovedí
     */
    public function citajOtazkyOdpovede() {
        try {
            $stmt = $this->conn->prepare("SELECT id, otazka, odpoved, datum_pridania FROM qna ORDER BY datum_pridania DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }
    
    /**
     * Metóda na vkladanie otázok a odpovedí do databázy
     * Kontroluje, či zadaná otázka už existuje v databáze
     * @param string $otazka Text otázky
     * @param string $odpoved Text odpovede
     * @return array Výsledok operácie s príslušnou správou
     */
    public function vlozOtazkuOdpoved($otazka, $odpoved) {
        // Kontrola prázdnych hodnôt
        if (empty($otazka) || empty($odpoved)) {
            return ['success' => false, 'message' => 'Otázka aj odpoveď musia byť vyplnené!'];
        }
        
        try {
            // Kontrola, či už otázka existuje
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM qna WHERE otazka = :otazka");
            $stmt->bindParam(':otazka', $otazka);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                return ['success' => false, 'message' => 'Táto otázka už v databáze existuje!'];
            }
            
            // Vloženie novej otázky a odpovede
            $stmt = $this->conn->prepare("INSERT INTO qna (otazka, odpoved) VALUES (:otazka, :odpoved)");
            $stmt->bindParam(':otazka', $otazka);
            $stmt->bindParam(':odpoved', $odpoved);
            $stmt->execute();
            
            return ['success' => true, 'message' => 'Otázka a odpoveď boli úspešne pridané!'];
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Chyba pri vkladaní do databázy: ' . $e->getMessage()];
        }
    }
    
    /**
     * Metóda na získanie konkrétnej otázky a odpovede podľa ID
     * @param int $id ID otázky
     * @return array|null Otázka a odpoveď alebo null ak neexistuje
     */
    public function ziskajOtazkuPodlaId($id) {
        try {
            $stmt = $this->conn->prepare("SELECT id, otazka, odpoved FROM qna WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }
    
    /* 
     * Metóda na vymazanie otázky a odpovede - zakomentovaná podľa požiadavky
     * @param int $id ID otázky na vymazanie
     * @return bool Úspech operácie
     */
    // public function vymazOtazku($id) {
    //     try {
    //         $stmt = $this->conn->prepare("DELETE FROM qna WHERE id = :id");
    //         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         return false;
    //     }
    // }
}
?>