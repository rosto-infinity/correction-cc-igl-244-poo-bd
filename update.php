<?php
// update.php

require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    // Mise à jour du produit
    $stmt = $pdo->prepare("UPDATE produit SET libelle = :libelle WHERE id = :id");
    $stmt->execute(['libelle' => $_POST['libelle'], 'id' => $_POST['id']]);

    header("Location: index_produit.php");
    exit;
  
} else {
  // Récupérer le produit à modifier
  $id = $_GET['id'];
  try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM produit WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un Produit</title>
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
    <h1>Modifier un Produit</h1>
    <form method="POST">
      <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">
      <label for="libelle">Libellé:</label>
      <input type="text" id="libelle" name="libelle" value="<?php echo $produit['libelle']; ?>" required>
      <button type="submit">Modifier</button>
    </form>
    <a href="index_produit.php">Retourner à la liste des produits</a>
  </div>

</body>

</html>