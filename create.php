<?php
// create.php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
        // Insertion d'un nouveau produit
        $stmt = $pdo->prepare("INSERT INTO produit (libelle,description) VALUES (:libelle,:description)");
        $stmt->execute([
          'libelle' => $_POST['libelle'],
          'description' => $_POST['description']
        ]);

        header("Location: index_produit.php");
        exit;

}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter un Produit</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
  }

  .container {
    max-width: 500px;
    margin: auto;
    padding: 20px;
    background: white;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  h1 {
    text-align: center;
    color: #333;
  }

  label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
  }

  input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  button {
    width: 100%;
    padding: 10px;
    background-color: #5cb85c;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  button:hover {
    background-color: #4cae4c;
  }

  a {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
  }

  a:hover {
    text-decoration: underline;
  }
  </style>
</head>

<body>
  <div class="container">
    <h1>Ajouter un Produit</h1>
    <form method="POST">
      <label for="libelle">Libellé:</label>
      <input type="text" id="libelle" name="libelle" required>
      <label for="libelle">Description:</label>
      <input type="text" id="description" name="description" required>
      <button type="submit">Ajouter</button>
    </form>
    <a href="index_produit.php">Retourner à la liste des produits</a>
  </div>
</body>

</html>