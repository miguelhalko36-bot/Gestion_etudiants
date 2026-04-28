<?php
require 'db.php';
$filieres = $pdo->query("SELECT * FROM filieres")->fetchAll();
$query = "SELECT e.*, f.nom as filiere_nom FROM etudiants e JOIN filieres f ON e.filiere_id = f.id";
$etudiants = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
<div class="container">
    <h2>Ajouter un nouvel étudiant</h2>
    <div id="error-msg" class="error-msg"></div>
    <form id="studentForm" action="traitement.php" method="POST">
        <input type="text" name="nom" id="nom" placeholder="Nom de l'étudiant">
        <input type="text" name="prenom" id="prenom" placeholder="Prénom de l'étudiant">
        <select name="filiere_id" class="full-width">
            <?php foreach($filieres as $f): ?>
                <option value="<?= $f['id'] ?>"><?= htmlspecialchars($f['nom']) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="ajouter" class="full-width">Ajouter l'étudiant</button>
    </form>
    <h2>Liste des étudiants enregistrés</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($etudiants as $etd): ?>
            <tr>
                <td><?= htmlspecialchars($etd['nom']) ?></td>
                <td><?= htmlspecialchars($etd['prenom']) ?></td>
                <td><?= htmlspecialchars($etd['filiere_nom']) ?></td>
                <td class="actions">
                    <a href="update.php?id=<?php echo $etd['id']; ?>" class="btn-edit">Modifier</a>
                     <a href="delete.php?id=<?php echo $etd['id']; ?>" class="btn-delete" onclick="return confirmDelete()">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="Assets/js/script.js"></script>
</body>
</html>
