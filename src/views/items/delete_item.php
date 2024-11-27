<?php
require_once("../../config/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        die("No se ha recibido un ID.");
    }

    try {
        $stmt = $db->prepare("DELETE FROM items WHERE id = :id");
        $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);

        if ($stmt->execute()) {
            
            header("Location: create_item.php?success=1");
            exit;
        } else {
            die("No se pudo eliminar el item.");
        }
    } catch (PDOException $e) {
        die("Error al borrar el ítem: " . $e->getMessage());
    }

} else {
    die("Metodo no permitido.");
}


