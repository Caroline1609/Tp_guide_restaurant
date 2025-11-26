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
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, visite FROM {$this->table}"; // Requête SQL pour récupérer toutes les lignes
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




    public function infoTable(): array
    {
        $stmt = $this->pdo->query("DESCRIBE {$this->table}");
        $columns = [];
        $primaryKey = '';

        foreach ($stmt->fetchAll() as $col) {
          array_push($columns, $col['Field']);
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
    $data = $this->searchAll(); // inclut l'id dans les données, mais pas affiché
    if (empty($data)) {
        return '<p>Aucune donnée à afficher.</p>';
    }

    // On prend toutes les colonnes sauf 'id' pour l'affichage
    $columns = array_keys($data[0]);
    $displayColumns = array_filter($columns, fn($col) => $col !== 'id');

    $html = '<table>';
    
    // Entête
    $html .= '<thead><tr>';
    foreach ($displayColumns as $col) {
        $html .= '<th>' . htmlspecialchars($col) . '</th>';
    }
    $html .= '<th>Modifier</th>'; // Colonne pour les boutons
    $html .= '<th>Supression</th>';
    $html .= '</tr></thead>';

    // Corps du tableau
    $html .= '<tbody>';
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($displayColumns as $col) {
            $html .= '<td>' . htmlspecialchars($row[$col]) . '</td>';
        }
         $html .= '<td><a class="btn-edit" href="modifier.php?id=' . $row['id'] . '">Modifier</a></td>';

            // Supprimer
        $html .= '<td>';
        $html .= '<form method="post" action="../src/dao/delete.php" style="display:inline;" onsubmit="return confirm(\'Confirmer la suppression ?\');">';
        $html .= '<input type="hidden" name="id" value="' . $row['id'] . '">';
        $html .= '<button type="submit" class="btn-delete">Supprimer</button>';
        $html .= '</form>';
        $html .= '</td>';
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

    public function deleteById(int $id): bool
    {
    $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
    return $stmt->execute([':id' => $id]);
    }


    
}
