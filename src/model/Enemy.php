<?php
class Enemy {
    private $db;
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
//save
    public function save() {
        $sql = "INSERT INTO enemies (name, description, isBoss, health, strength, defense, img)
                VALUES (:name, :description, :isBoss, :health, :strength, :defense, :img)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':isBoss', $this->isBoss);
        $stmt->bindParam(':health', $this->health);
        $stmt->bindParam(':strength', $this->strength);
        $stmt->bindParam(':defense', $this->defense);
        $stmt->bindParam(':img', $this->img);

        return $stmt->execute();
    }

    public static function getAll($db) {
        $stmt = $db->query("SELECT * FROM enemies");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
