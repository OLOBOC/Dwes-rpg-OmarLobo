<?php
require_once("../../config/db.php");
require_once("../../model/item.php");

$items = Item::getAll($db);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = new Item($db);

    $item->setName($_POST['name'])
         ->setDescription($_POST['description'])
         ->setType($_POST['type'])
         ->setEffect($_POST['effect'])
         ->setImg($_POST['img']);

    if ($item->save()) {
        echo "¡item guardado com exito!";
        
    } else {
        echo "Error al guardar el ítem.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear item</title>
</head>
<body>
    <?php include('../partials/_menu.php'); ?>
    <h1>Crear item</h1>
    <form action="create_item.php" method="POST">
        <label for="name">Nombre del item:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Descripcion:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="type">Tipo:</label><br>
        <select id="type" name="type" required>
            <option value="weapon">Weapon</option>
            <option value="armor">Armor</option>
            <option value="potion">Potion</option>
            <option value="misc">Misc</option>
        </select><br><br>

        <label for="effect">Efecto:</label><br>
        <input type="number" id="effect" name="effect" required><br><br>

        <label for="img">Imagen (URL o archivo):</label><br>
        <input type="text" id="img" name="img"><br><br>

        <button type="submit">Guardar item</button>
    </form>
    
        <h1>Listado de items</h1>

    <!-- Mostrar items en tabla -->
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Tipo</th>
                <th>Efecto</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item) : ?>
                <tr>
                    
                    <td><img src="<?= $item['img'] ?>" alt="Imagen del item" width="100"></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['description'] ?></td>
                    <td><?= $item['type'] ?></td>
                    <td><?= $item['effect'] ?></td>
                    <td><?= $item['img'] ?></td>
                    <td>
                      
                        <form action="edit_item.php" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit">Editar</button>
                        </form>

                    
                        <form action="delete_item.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>