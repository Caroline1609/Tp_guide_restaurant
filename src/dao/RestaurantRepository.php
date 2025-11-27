<?php
require_once __DIR__ . '/Dbconnexion.php';

class RestoRepository
{
    private PDO $pdo; // Instance de PDO pour la connexion à la base de données
    private string $table = "restaurant"; // Nom de la table

    public function __construct() // Constructeur
    {
        $this->pdo = Dbconnexion::getInstance(); // Récupère l'instance de PDO
    }


    public function searchAll(): array // Récupère toutes les lignes de la table
    {
        $sql = "SELECT id, nom, adresse, prix, commentaire, note, DATE_FORMAT(visite, '%d/%m/%Y') AS visite FROM {$this->table}"; // Requête SQL pour récupérer toutes les lignes
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

    public function searchById(int $id): array // Récupère une ligne par son ID
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id"); // Requête SQL pour récupérer une ligne par ID
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Liaison du paramètre
        $stmt->execute(); // Exécution de la requête
        return $stmt->fetch(); // Récupération des résultats
    }




    public function infoTable(): array // Récupère les informations sur la table
    {
        $stmt = $this->pdo->query("DESCRIBE {$this->table}"); // Requête SQL pour décrire la table
        $columns = []; // Tableau pour stocker les noms des colonnes
        $primaryKey = ''; // Variable pour stocker la clé primaire

        foreach ($stmt->fetchAll() as $col) { // Parcourt chaque colonne
          array_push($columns, $col['Field']); // Ajoute le nom de la colonne au tableau
            if ($col['Key'] === 'PRI') { // Si la colonne est une clé primaire
                $primaryKey = $col['Field']; // Stocke le nom de la clé primaire
            }
        }

        return [ // Retourne un tableau avec les colonnes et la clé primaire
            'columns' => $columns, // Noms des colonnes
            'primaryKey' => $primaryKey // Nom de la clé primaire
        ];
    }


    public function renderHtml(): string // Génère le code HTML pour afficher les données dans un tableau
{
    $data = $this->searchAll(); // inclut l'id dans les données, mais pas affiché
    if (empty($data)) { // Si aucune donnée
        return '<p>Aucune donnée à afficher.</p>'; // Message d'absence de données
    }

    // On prend toutes les colonnes sauf 'id' pour l'affichage
    $columns = array_keys($data[0]); // Récupère les noms des colonnes
    $displayColumns = array_filter($columns, fn($col) => $col !== 'id'); // Filtre pour exclure 'id'

    $html = '<table>'; // Début du tableau HTML
    
    // Entête
    $html .= '<thead><tr>';
    foreach ($displayColumns as $col) { // Parcourt chaque colonne à afficher
        $html .= '<th>' . htmlspecialchars($col) . '</th>';
    }
    $html .= '<th>Modifier</th>'; // Colonne pour les boutons
    $html .= '<th>Supression</th>';
    $html .= '</tr></thead>';

    // Corps du tableau
    $html .= '<tbody>';
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($displayColumns as $col) { // Parcourt chaque colonne à afficher
            $html .= '<td>' . htmlspecialchars($row[$col]) . '</td>'; // Affiche chaque cellule
        }
         $html .= '<td><a class="btn-edit" href="../vue/modifCritique.php?id=' . $row['id'] . '">Modifier</a></td>';
        $html .= '<td>';
        $html .= '<form method="post" action="../src/dao/delete.php" onsubmit="return confirm(\'Confirmer la suppression ?\');">';
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

 
public function modifyRow(int $id, array $data): bool
{
    $sql = "UPDATE restaurant SET nom = :nom, adresse = :adresse, prix = :prix, commentaire = :commentaire, note = :note, visite = :visite WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $data['id'] = $id; // Ajoute l'ID aux données pour la requête
    return $stmt->execute($data);
}

public function chercherCollection(): void
{
    $sql = "SELECT * FROM {$this->table}";
    $stmt = $this->pdo->query($sql);
    $tab = '[' ;
    $file_path = __DIR__ . '/../../assets/json/bdd.json';
    $success = file_put_contents($file_path, $tab, FILE_APPEND);
    $tabObj = [];
    $compteur = 0;
    while ($row = $stmt->fetch()) {
        $compteur++;
        $json_data = json_encode($row, JSON_PRETTY_PRINT );
        $json_data .= ',';
         
        array_push($tabObj,$json_data);
    }
   $lastElement = $tabObj [count($tabObj)-1] ;
    $lastElement = substr($lastElement, 0, strlen($lastElement) - 1);
    echo $lastElement;
    $tabObj [count($tabObj) - 1] = $lastElement;


   $success = file_put_contents($file_path, $tabObj, FILE_APPEND);
    $fin = ']';
    $success = file_put_contents($file_path, $fin, FILE_APPEND); 


    
}

}
