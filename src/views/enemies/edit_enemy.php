<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");


$enemyId = isset($_GET['id']) ? intval($_GET['id']) : 0;


$enemy = new Enemy($db);
if (!$enemy->loadById($enemyId)) {
    echo "Enemigo no encontrado.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $enemy->setName($_POST['name'])
          ->setDescription($_POST['description'])
          ->setIsBoss(isset($_POST['isBoss']) ? 1 : 0)
          ->setHealth($_POST['health'])
          ->setStrength($_POST['strength'])
          ->setDefense($_POST['defense'])
          ->setImg($_POST['img']);

    
    if ($enemy->save()) {
        header("Location: list_enemy.php"); 
        exit;
    } else {
        echo "Error al actualizar el enemigo.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Enemigo</title>
</head>
<body>
    <h1>Editar Enemigo</h1>

    <form action="<?= $_SERVER['PHP_SELF'] . '?id=' . $enemyId ?>" method="POST">
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput" value="<?= $enemy->getName() ?>" required><br>

        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput" value="<?= $enemy->getDescription() ?>" required><br>

        <label for="isBoss">¿Es un jefe?</label>
        <input type="checkbox" name="isBoss" id="isBoss" <?= $enemy->getIsBoss() ? 'checked' : '' ?>><br>

        <label for="healthInput">Salud:</label>
        <input type="number" name="health" id="healthInput" value="<?= $enemy->getHealth() ?>" required><br>

        <label for="strengthInput">Fuerza:</label>
        <input type="number" name="strength" id="strengthInput" value="<?= $enemy->getStrength() ?>" required><br>

        <label for="defenseInput">Defensa:</label>
        <input type="number" name="defense" id="defenseInput" value="<?= $enemy->getDefense() ?>" required><br>

        <label for="imgInput">Imagen (URL o archivo):</label>
        <input type="text" name="img" id="imgInput" value="<?= $enemy->getImg() ?>"><br>

        <button type="submit">Guardar Cambios</button>
    </form>


</body>
</html>
