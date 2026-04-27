<?php
include_once 'db.php';
try {
    
    $queryF = $pdo->query("SELECT * FROM filieres");
    $filieres = $queryF->fetchAll(PDO::FETCH_ASSOC);
    $sql = "SELECT etudiants.*, filieres.nom AS nom_filiere
            FROM etudiants
            JOIN filieres ON etudiants.filiere_id = filieres.id
            ORDER BY etudiants.id DESC";
    $queryE = $pdo->query($sql);
    $etudiants = $queryE->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Étudiants</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un étudiant</h1>
       
        <form id="formEtudiant" action="traitement.php" method="POST">
            <div class="form-group">
                <label>Nom :</label>
                <input type="text" name="nom" id="nom">
            </div>
           
            <div class="form-group">
                <label>Prénom :</label>
                <input type="text" name="prenom" id="prenom">
            </div>
           
            <div class="form-group">
                <label>Filière :</label>
                <select name="filiere_id" id="filiere_id">
                    <option value="">-- Sélectionner une filière --</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= $filiere['id'] ?>"><?= $filiere['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
           
            <button type="submit">Enregistrer</button>
        </form>
          <hr>
        <h2>Liste des Étudiants</h2>
        <table border="1" style="width:100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Filière</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($etudiants) > 0): ?>
                    <?php foreach ($etudiants as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['nom']) ?></td>
                            <td><?= htmlspecialchars($e['prenom']) ?></td>
                            <td><?= htmlspecialchars($e['nom_filiere']) ?></td>
                            <td>
                                <a href="update.php?id=<;?= $e['id'] ?>">Modifier</a> |
                                <a href="delete.php?id=<;?= $e['id'] ?>" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">Aucun étudiant trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
  
    </div>
    <script src="Assets/js/script.js"></script>
</body>
</html>