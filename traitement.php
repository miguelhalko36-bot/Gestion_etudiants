<?php


include_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
   
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $filiere_id = $_POST['filiere_id'] ?? '';
    
    if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
        try {
            
            $sql = "INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (:nom, :prenom, :filiere_id)";
            $stmt = $pdo->prepare($sql);
           
            
            $stmt->execute([
                ':nom' => $nom,
                ':prenom' => $prenom,
                ':filiere_id' => $filiere_id
            ]);
            
            header("Location: index.php?success=1");
            exit();
        } catch (PDOException $e) {
            die("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    } else {
        
        //header("Location: index.php?error=empty");
        exit();
    }
} else {
    
    header("Location: index.php");
    exit();
}
?>