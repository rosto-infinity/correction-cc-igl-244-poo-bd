<?php
// delete.php
require_once('database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

        // Suppression du produit
        $stmt = $pdo->prepare("DELETE FROM produit WHERE id = :id");
        $stmt->execute(['id' => $id]);

        header("Location: index_produit.php");
        exit;
   
} else {
    echo "ID de produit non spécifié ok.";
}