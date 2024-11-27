<?php

class Item
{
    private $db;
    private $id;
    private $name;
    private $description;
    private $type;
    private $effect;
    private $img;


    public function __construct($db)
    {
        $this->db = $db;
    }


    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setEffect($effect)
    {
        $this->effect = $effect;
        return $this;
    }

    public function getEffect()
    {
        return $this->effect;
    }

    public function setImg($img)
    {
        $this->img = $img;
        return $this;
    }

    public function getImg()
    {
        return $this->img;
    }

    // guardar item en bd
    public function save()
    {
        try {
            if ($this->id) {

                $sql = "UPDATE items SET name = :name, description = :description, type = :type, effect = :effect, img = :img WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            } else {

                $sql = "INSERT INTO items (name, description, type, effect, img) VALUES (:name, :description, :type, :effect, :img)";
                $stmt = $this->db->prepare($sql);
            }


            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':effect', $this->effect, PDO::PARAM_INT);
            $stmt->bindParam(':img', $this->img);

            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error al guardar el item: " . $e->getMessage();
            return false;
        }
    }

    // obtener item
    public static function getAll($db)
    {
        try {
            $stmt = $db->query("SELECT * FROM items");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener los items: " . $e->getMessage();
            return [];
        }
    }
}
