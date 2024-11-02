<?php
require_once('database.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_produit = intval($_GET['id']);

    try {
        // Récupération de la nomenclature pour un produit spécifique
        $stmt = $pdo->prepare("
            SELECT n.nombre, p.libelle AS produit_libelle, c.libelle AS composant_libelle 
            FROM nomenclature n
            JOIN produit p ON n.id_produit = p.id
            JOIN composant c ON n.id_composant = c.id
            WHERE n.id_produit = :id_produit
        ");
        $stmt->execute(['id_produit' => $id_produit]);
        $nomenclature = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Récupérer le libellé du produit
        $stmt_produit = $pdo->prepare("SELECT libelle FROM produit WHERE id = :id_produit");
        $stmt_produit->execute(['id_produit' => $id_produit]);
        $produit = $stmt_produit->fetch(PDO::FETCH_ASSOC);

        if (!$produit) {
            echo "Produit non trouvé.";
            exit;
        }

    } catch (PDOException $e) {
        echo "Erreur : " . htmlspecialchars($e->getMessage());
        exit;
    }
} else {
    echo "ID de produit non spécifié ou invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Nomenclature de <?php echo htmlspecialchars($produit['libelle']); ?></title>
  <style>
  body {
    font-family: Arial, sans-serif;

    margin: 0;
    padding: 20px;
  }

  h1 {
    text-align: center;
    color: #333;
  }

  a {
    display: inline-block;
    margin: 0;
    padding: 10px 15px;
    background-color: #5cb85c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }

  a:hover {
    background-color: #4cae4c;

  }

  .main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  table {
    width: 50%;
    border-collapse: collapse;
    margin-top: 20px;
    margin-bottom: 15px;
    background: white;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ccc;
  }

  th {
    background-color: #4cae4c;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  tr:hover {
    background-color: #f1f1f1;
  }

  .actions a {
    margin-right: 10px;
    color: white;
  }

  .actions a:hover {
    text-decoration: underline;
  }
  </style>
</head>

<body>
  <div class="main">
    <h1>Nomenclature de <?php echo htmlspecialchars($produit['libelle']); ?></h1>
    <table border="1">
      <tr>
        <th>Composant</th>
        <th>Quantité</th>
      </tr>
      <?php if (empty($nomenclature)): ?>
      <tr>
        <td colspan="2">Aucune nomenclature trouvée pour ce produit.</td>
      </tr>
      <?php else: ?>
      <?php foreach ($nomenclature as $item): ?>
      <tr>
        <td><?php echo htmlspecialchars($item['composant_libelle']); ?></td>
        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <div><a href="create_nomenclature.php">Ajouter une nouvelle nomenclature</a>
      <a href="index_nomenclature.php">Retourner à la liste des produits</a>
    </div>
  </div>
</body>

</html>