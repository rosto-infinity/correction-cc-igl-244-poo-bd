<?php
// index_component.php
require_once('database.php');

try {
  $pdo = new PDO($dsn, $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Récupération de tous les composants
  $stmt = $pdo->query("SELECT * FROM composant");
  $composants = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Liste des Composants</title>
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
  </style>
</head>

<body>
  <div class="main">
    <h1>Liste des Composants</h1>
    <a href="create_component.php">Ajouter un nouveau composant</a>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Libellé</th>
        <th>Description</th>
        <th>Coût</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($composants as $composant): ?>
      <tr>
        <td><?php echo $composant['id']; ?></td>
        <td><?php echo $composant['libelle']; ?></td>
        <td><?php echo $composant['description']; ?></td>
        <td><?php echo $composant['cout']; ?></td>
        <td>
          <a href="update_component.php?id=<?php echo $composant['id']; ?>">Modifier</a>
          <a href="delete_component.php?id=<?php echo $composant['id']; ?>"
            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce composant ?');">Supprimer</a>
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