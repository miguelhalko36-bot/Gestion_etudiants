<?php
require 'db.php';
if (isset($_POST['ajouter'])) {
    $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['filiere_id']]);
    header("Location: index.php");
}
if (isset($_POST['modifier'])) {
    $stmt = $pdo->prepare("UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['filiere_id'], $_POST['id']]);
    header("Location: index.php");
}
?>
