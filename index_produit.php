<?php
// index.php
require_once('database.php');

// Récupération de tous les produits
$stmt = $pdo->query("SELECT * FROM produit");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Produits</title>
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
    <h1>Liste des Produits</h1>
    <a href="create.php">Ajouter un nouveau produit</a>
    <table>
      <tr>
        <th>ID</th>
        <th>Libellé</th>
        <th>
          <Div></Div>escription
        </th>
        <th>Actions</th>
      </tr>
      <?php foreach ($produits as $produit): ?>
      <tr>
        <td><?php echo $produit['id']; ?></td>
        <td><?php echo $produit['libelle']; ?></td>
        <td><?php echo $produit['description']; ?></td>
        <td class="actions">
          <a href="update.php?id=<?php echo $produit['id']; ?>">Modifier</a>
          <a href="delete.php?id=<?php echo $produit['id']; ?>"
            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">Supprimer</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
    <div>
      <a href="index_produit.php">Produit(s)</a>
      <a href="index_component.php">Composant(s)</a>
      <a href="index_nomenclature.php">Nomenclature</a>
    </div>
  </div>
</body>

</html>