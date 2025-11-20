<?php
class DbConnection {
    // Stocke l'unique instance de la classe (pattern Singleton)
    private static ?DbConnection $instance = null;
    // Stocke l'objet PDO
    private PDO $connexion;

    // Constantes de configuration pour la connexion à la base
    private const HOST = "localhost";
    private const DBNAME = "db_guide";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const PORT = 3306;

    // Constructeur privé pour empêcher l'instanciation directe
    private function __construct() {
        try {
            $this->connexion = new PDO(
                "mysql:host=" . self::HOST . ";port=" . self::PORT . ";dbname=" . self::DBNAME . ";charset=utf8",
                self::USERNAME,
                self::PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (Exception $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage()); 
        }
    }

    // Méthode pour obtenir l'instance unique
    public static function getInstance(): DbConnection {
        if (self::$instance === null) {
            self::$instance = new DbConnection();
        }
        return self::$instance;
    }

    // Méthode pour obtenir la connexion PDO
    public function getConnection(): PDO {
        return $this->connexion;
    }
}
