<?php
require_once "DbConnection.php";

class RestoRepository {

    private PDO $pdo;
    private string $table = "restaurant";

    public function __construct() {
        $this->pdo = DbConnection::getInstance()->getConnection();
    }


    public function searchAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}