<?php
require_once("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("No se ha recibido un ID.");
    }

    try {
        
        $stmt = $db->prepare("DELETE FROM enemies WHERE id = :id");
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            
            header("Location: create_enemy.php?");
            exit;
        } else {
            die("No se pudo eliminar el enemigo.");
        }
    } catch (PDOException $e) {
       
        die("Error al borrar el enemigo: " . $e->getMessage());
    }

} else {
    
    die("Mrtodo no permitido.");
}

