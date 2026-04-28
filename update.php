<?php
require 'db.php';
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$_GET['id']]);
$etudiant = $stmt->fetch();
$filieres = $pdo->query("SELECT * FROM filieres")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Étudiant</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Modifier les informations</h2>
    <div id="error-msg" class="error-msg"></div>
    <form id="studentForm" action="traitement.php" method="POST">
        <input type="hidden" name="id" value="<?= $etudiant['id'] ?>">
        <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>">
        <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>">
        <select name="filiere_id" class="full-width">
            <?php foreach($filieres as $f): ?>
                <option value="<?= $f['id'] ?>" <?= $f['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($f['nom']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="modifier" class="full-width" style="background-color: #007bff;">Enregistrer les modifications</button>
    </form>
</div>
<script src="Assets/js/script.js"></script>
</body>
</html>
?>
