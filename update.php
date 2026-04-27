<?php
include_once 'db.php';
// 1. On récupère l'étudiant à modifier
if (isset($_post['id'])) {
    $id = $_GET['id'];
    $req = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
    $req->execute([$id]);
    $etudiant = $req->fetch(PDO::FETCH_ASSOC);
    if (!$etudiant) {
        die("Étudiant introuvable.");
    }
} else {
    header("Location: index.php");
    exit();
}
// 2. On récupère les filières pour le menu déroulant
$query = $pdo->query("SELECT * FROM filieres");
$filieres = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Modifier les informations</h2>
       
        <form id="formEtudiant" action="traitement.php" method="POST">
            <input type="hidden" name="id_etudiant" value="<?= $etudiant['id'] ?>">
            <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
            <input type="text" name="prenom" id="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
           
            <select name="filiere_id" id="filiere_id" required>
                <?php foreach ($filieres as $f): ?>
                    <option value="<?= $f['id'] ?>" <?= ($f['id'] == $etudiant['filiere_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($f['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
           
            <button type="submit" name="modifier">Enregistrer les modifications</button>
            <br><br>
            <a href="index.php" style="text-align:center; display:block; color:#666;">Annuler</a>
        </form>
    </div>
    <script src="Assets/js/script.js"></script>
</body>
</html>