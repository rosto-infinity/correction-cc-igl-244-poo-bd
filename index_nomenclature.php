<?php
require_once('database.php');

try {
    // Récupération de tous les produits
    $stmt = $pdo->prepare("SELECT p.id, p.libelle FROM produit p");
    $stmt->execute();
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . htmlspecialchars($e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Produits et Nomenclatures</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;

  }

  .main {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
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

  table {
    width: 40%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
    margin-bottom: 20px;
  }

  th,
  td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ccc;
  }

  th {
    background-color: #4cae4c;
    /* background-color: red; */
    color: white;
  }


  tr td {
    height: 0px;
    padding: 5px;
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

  .lien {
    margin-top: 10px;
  }
  </style>
</head>

<body>
  <div class="main">


    <h1>Liste des Produits</h1>
    <table border="1">
      <tr>
        <th>Nom du Produit</th>
        <th>Actions</th>
      </tr>
      <?php if (empty($produits)): ?>
      <tr>
        <td colspan="2">Aucun produit trouvé.</td>
      </tr>
      <?php else: ?>
      <?php foreach ($produits as $produit): ?>
      <tr>
        <td><?php echo htmlspecialchars($produit['libelle']); ?></td>
        <td>
          <a href="nomenclature.php?id=<?php echo $produit['id']; ?>">Voir Nomenclature</a>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>
    </table>
    <a href="create_nomenclature.php">Ajouter une nouvelle nomenclature</a>
    <div class="lien">
      <a href="index_produit.php">Produit(s)</a>
      <a href="index_component.php">Composant(s)</a>
      <a href="index_nomenclature.php">Nomenclature</a>
    </div>
  </div>
</body>

</html>