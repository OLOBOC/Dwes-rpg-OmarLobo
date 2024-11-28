<?php
require_once("../../config/db.php");
require_once("../../model/Enemy.php");

$enemys = Enemy::getAll($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Enemigo</title>
</head>
<body>
    <h1>Menú:</h1>
    <?php include('../partials/_menu.php') ?>

    <h1>Crea tu enemigo</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
        <label for="nameInput">Nombre:</label>
        <input type="text" name="name" id="nameInput" required><br>

        <label for="descriptionInput">Descripción:</label>
        <input type="text" name="description" id="descriptionInput" required><br>

        <label for="isBoss">¿Es un jefe?</label>
        <input type="checkbox" name="isBoss" id="isBoss"><br>

        <label for="healthInput">Salud:</label>
        <input type="number" name="health" id="healthInput" value="100" required><br>

        <label for="strengthInput">Fuerza:</label>
        <input type="number" name="strength" id="strengthInput" value="10" required><br>

        <label for="defenseInput">Defensa:</label>
        <input type="number" name="defense" id="defenseInput" value="10" required><br>

        <label for="imgInput">Imagen (URL o archivo):</label>
        <input type="text" name="img" id="imgInput"><br>

        <button type="submit">Crear Enemigo</button>
    </form>

    <h1>Enemigos creados:</h1>
    <table>
        <thead>
            <tr>
                
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Salud</th>
                <th>Fuerza</th>
                <th>Defensa</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($enemys as $enemy) : ?>
                <tr>
                    
                    <td><?= $enemy['name'] ?></td>
                    <td><?= $enemy['description'] ?></td>
                    <td><?= $enemy['health'] ?></td>
                    <td><?= $enemy['strength'] ?></td>
                    <td><?= $enemy['defense'] ?></td>
                    <td><img src="" alt=""></td>
                    <td>
                        <form action="edit_enemy.php" method="GET">
                            <input type="hidden" name="id" value="<?= $enemy['id'] ?>">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="delete_enemy.php" method="POST">
                            <input type="hidden" name="id" value="<?= $enemy['id'] ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>