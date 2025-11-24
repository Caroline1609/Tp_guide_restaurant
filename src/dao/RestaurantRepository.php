<?php
require_once __DIR__ . '/Dbconnexion.php';

class RestoRepository
{
    private PDO $pdo;
    private string $table = "restaurant"; // Nom de la table

    public function __construct()
    {
        $this->pdo = Dbconnexion::getInstance();
    }


    public function searchAll(): array
    {
        $sql = "SELECT nom, adresse, prix, commentaire, note, visite FROM {$this->table}"; // Requête SQL pour récupérer toutes les lignes
        $stmt = $this->pdo->query($sql); //
        return $stmt->fetchAll();
    }

    // public function searchByName(string $_nom): array
    // {
    //     $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE soundex(nom) = soundex(:nom)");
    //     $stmt->bindValue(':id', $_nom, PDO::PARAM_STR); // Liaison du paramètre
    //     $stmt->execute();
    //     return $stmt->fetchAll();
    // }


    public function searchById(int $id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Liaison du paramètre
        $stmt->execute();
        return $stmt->fetchAll();
    }




    private function infoTable(): array
    {
        $stmt = $this->pdo->query("DESCRIBE {$this->table}");
        $columns = [];
        $primaryKey = '';

        foreach ($stmt->fetchAll() as $col) {
            $columns[] = $col['Field'];
            if ($col['Key'] === 'PRI') {
                $primaryKey = $col['Field'];
            }
        }

        return [
            'columns' => $columns,
            'primaryKey' => $primaryKey
        ];
    }


    public function renderHtml(): string
    {
        $data = $this->searchAll();

        if (empty($data)) {
            return '<p>Aucune donnée à afficher.</p>';
        }

        // Récupérer les colonnes depuis les clés du premier enregistrement
        $columns = array_keys($data[0]);

        $html = '<table>';

        // Ligne des colonnes
        $html .= '<thead><tr>';
        foreach ($columns as $col) {
            $html .= '<th>' . htmlspecialchars($col) . '</th>';
        }
        $html .= '</tr></thead>';

        // Corps du tableau
        $html .= '<tbody>';
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($columns as $col) {
                $html .= '<td>' . htmlspecialchars($row[$col]) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';

        return $html;
    }


   public function insertRow($data)

    {
        // On écrit la requête SQL avec des "placeholders" pour sécuriser les données
        $sql = "INSERT INTO {$this->table} (nom, adresse, prix, commentaire, note, visite) 
                VALUES (:nom, :adresse, :prix, :commentaire, :note, :visite)";

        // Préparation de la requête
        $stmt = $this->pdo->prepare($sql); 
         // On exécute la requête en envoyant les valeurs
        return $stmt->execute([ 
            ':nom' => $data['nom'],
            ':adresse' => $data['adresse'],
            ':prix' => $data['prix'],
            ':commentaire' => $data['commentaire'],
            ':note' => $data['note'],
            ':visite' => $data['visite']
        ]);
    }
}
