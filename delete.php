 <?php
include_once 'db.php';
if (isset($_POST['id']) && !empty($_POST['id'])) {
    try {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: index.php?msg=deleted");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la suppression : " . $e->getMessage());
    }
} else {
    header("Location: index.php");
    exit();
}