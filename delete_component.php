<?php
// delete_component.php
require_once('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Vérification si le composant est lié à un produit
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM nomenclature WHERE id_composant = :id");
        $stmt->execute(['id' => $id]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "Le composant ne peut pas être supprimé car il est lié à un produit.";
        } else {
            // Suppression du composant
            $stmt = $pdo->prepare("DELETE FROM composant WHERE id = :id");
            $stmt->execute(['id' => $id]);
            header("Location: index_component.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression : " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "ID de composant non spécifié.";
}
?>