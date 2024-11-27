<?php
require_once("../../config/db.php");
require_once("../../model/item.php");

// Obtener el ID del ítem desde la URL
$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Obtener el ítem actual
$item = Item::getById($db, $itemId);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item->setName($_POST['name'])
         ->setDescription($_POST['description'])
         ->setType($_POST['type'])
         ->setEffect($_POST['effect'])
         ->setImg($_POST['img']);

    if ($item->save()) {
        header("Location: list_item.php");
        exit;
    } else {
        echo "Error al actualizar el ítem.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar item</title>
</head>
<body>
    <h1>Editar Ítem</h1>
    <form method="POST">
    <label>Nombre:</label>
<input type="text" name="name" value="<?= $item->getName() ?>" required><br>

<label>Descripción:</label>
<textarea name="description" required><?= $item->getDescription() ?></textarea><br>

        
        <label>Tipo:</label>
        <select name="type" required>
            <option value="weapon" <?= $item->getType() == 'weapon' ? 'selected' : '' ?>>Arma</option>
            <option value="armor" <?= $item->getType() == 'armor' ? 'selected' : '' ?>>Armadura</option>
            <option value="potion" <?= $item->getType() == 'potion' ? 'selected' : '' ?>>Poción</option>
            <option value="misc" <?= $item->getType() == 'misc' ? 'selected' : '' ?>>Misceláneo</option>
        </select><br>
        
        <label>Efecto:</label>
        <input type="number" name="effect" value="<?= $item->getEffect() ?>" required><br>
        
        <label>Imagen:</label>
        <input type="text" name="img" value="<?= $item->getImg() ?>"><br>
        
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>


