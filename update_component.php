<?php
// update_component.php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mise à jour du composant
        $stmt = $pdo->prepare("UPDATE composant SET libelle = :libelle, description = :description, cout = :cout WHERE id = :id");
        $stmt->execute([
            'libelle' => $_POST['libelle'],
            'description' => $_POST['description'],
            'cout' => $_POST['cout'],
            'id' => $_POST['id']
        ]);

        header("Location: index_component.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . htmlspecialchars($e->getMessage());
    }
} else {
    // Récupérer le composant à modifier
    $id = $_GET['id'];
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM composant WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $composant = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur : " . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Modifier un Composant</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
  }

  h1 {
    text-align: center;
    color: #333;
  }

  form {
    max-width: 400px;
    margin: 0 auto;
    background: white;
    padding: 28px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  input[type="text"],
  input[type="number"],
  textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
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
    display: inline-block;
    margin-top: 20px;
    text-align: center;
    color: #333;
    text-decoration: none;
  }
  </style>
</head>

<body>
  <h1>Modifier un Composant</h1>
  <form method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($composant['id']); ?>">
    <label for="libelle">Libellé:</label>
    <input type="text" id="libelle" name="libelle" value="<?php echo htmlspecialchars($composant['libelle']); ?>"
      required>
    <label for="description">Description:</label>
    <textarea id="description" name="description"
      required><?php echo htmlspecialchars($composant['description']); ?></textarea>
    <label for="cout">Coût:</label>
    <input type="number" id="cout" name="cout" value="<?php echo htmlspecialchars($composant['cout']); ?>" required>
    <button type="submit">Modifier</button>
    <a href="index_component.php">Retourner à la liste des composants</a>
  </form>
</body>

</html>