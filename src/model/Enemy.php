<?php
class Enemy {
    private $db;
    private $id;
    private $name;
    private $description;
    private $isBoss;
    private $health;
    private $strength;
    private $defense;
    private $img;

    public function __construct($db) {
        $this->db = $db;
    }

   
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setIsBoss($isBoss) {
        $this->isBoss = $isBoss;
        return $this;
    }

    public function setHealth($health) {
        $this->health = $health;
        return $this;
    }

    public function setStrength($strength) {
        $this->strength = $strength;
        return $this;
    }

    public function setDefense($defense) {
        $this->defense = $defense;
        return $this;
    }

    public function setImg($img) {
        $this->img = $img;
        return $this;
    }

   
    public function save() {
        if (isset($this->id)) { 
            $sql = "UPDATE enemies 
                    SET name = :name, description = :description, isBoss = :isBoss, 
                        health = :health, strength = :strength, defense = :defense, img = :img 
                    WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $this->id); 
        } else {
            $sql = "INSERT INTO enemies (name, description, isBoss, health, strength, defense, img)
                    VALUES (:name, :description, :isBoss, :health, :strength, :defense, :img)";
            $stmt = $this->db->prepare($sql);
        }

        
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':isBoss', $this->isBoss);
        $stmt->bindParam(':health', $this->health);
        $stmt->bindParam(':strength', $this->strength);
        $stmt->bindParam(':defense', $this->defense);
        $stmt->bindParam(':img', $this->img);

        return $stmt->execute();
    }

    // getall para lista
    public static function getAll($db) {
        $stmt = $db->query("SELECT * FROM enemies");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // load para el editar
    public function loadById($id) {
        $stmt = $this->db->prepare("SELECT * FROM enemies WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        $enemy = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($enemy) {
            $this->id = $enemy['id'];         
            $this->name = $enemy['name'];
            $this->description = $enemy['description'];
            $this->isBoss = $enemy['isBoss'];
            $this->health = $enemy['health'];
            $this->strength = $enemy['strength'];
            $this->defense = $enemy['defense'];
            $this->img = $enemy['img'];
            return true;
        }
        return false; 
    }

   
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIsBoss() {
        return $this->isBoss;
    }

    public function getHealth() {
        return $this->health;
    }

    public function getStrength() {
        return $this->strength;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function getImg() {
        return $this->img;
    }
}

