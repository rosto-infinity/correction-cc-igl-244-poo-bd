<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Vérifier si la combinaison id_produit et id_composant existe déjà
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM nomenclature WHERE id_produit = :id_produit AND id_composant = :id_composant");
        $stmt_check->execute([
            'id_produit' => $_POST['id_produit'],
            'id_composant' => $_POST['id_composant']
        ]);
        $exists = $stmt_check->fetchColumn();

        if ($exists) {
            echo "Cette combinaison de produit et de composant existe déjà.";
        } else {
            // Insertion d'une nouvelle nomenclature
            $stmt = $pdo->prepare("INSERT INTO nomenclature (id_produit, id_composant, nombre) VALUES (:id_produit, :id_composant, :nombre)");
            $stmt->execute([
                'id_produit' => $_POST['id_produit'],
                'id_composant' => $_POST['id_composant'],
                'nombre' => $_POST['nombre']
            ]);

            header("Location: index_nomenclature.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion : " . htmlspecialchars($e->getMessage());
    }
}

// Récupérer les produits et composants pour le formulaire
try {
    $produits = $pdo->query("SELECT * FROM produit")->fetchAll(PDO::FETCH_ASSOC);
    $composants = $pdo->query("SELECT * FROM composant")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur lors de la récupération des données : " . htmlspecialchars($e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Ajouter une Nomenclature</title>
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
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  label {
    display: block;
    margin-bottom: 5px;
  }

  select,
  input[type="number"] {
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
  <h1>Ajouter une Nomenclature</h1>
  <form method="POST">
    <label for="id_produit">Produit:</label>
    <select id="id_produit" name="id_produit" required>
      <?php foreach ($produits as $produit): ?>
      <option value="<?php echo $produit['id']; ?>"><?php echo htmlspecialchars($produit['libelle']); ?></option>
      <?php endforeach; ?>
    </select>

    <label for="id_composant">Composant:</label>
    <select id="id_composant" name="id_composant" required>
      <?php foreach ($composants as $composant): ?>
      <option value="<?php echo $composant['id']; ?>"><?php echo htmlspecialchars($composant['libelle']); ?></option>
      <?php endforeach; ?>
    </select>

    <label for="nombre">Quantité:</label>
    <input type="number" id="nombre" name="nombre" required min="1">

    <button type="submit">Ajouter</button>
    <a href="index_nomenclature.php">Retourner à la liste des nomenclatures</a>
  </form>
</body>

</html>