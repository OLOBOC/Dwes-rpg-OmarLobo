<?php
class Character{
    protected $id;
    protected $name;
    protected $description;
    protected $health;
    protected $strength;
    protected $defense;
    protected $image;

    protected $db;

    public function __construct($db){
        $this->db = $db;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of health
     */ 
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set the value of health
     *
     * @return  self
     */ 
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get the value of strength
     */ 
    public function getStrength()
    {
        return $this->strength;
    }

    /**
     * Set the value of strength
     *
     * @return  self
     */ 
    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    /**
     * Get the value of defense
     */ 
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set the value of defense
     *
     * @return  self
     */ 
    public function setDefense($defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
    

    
    function save() {
        if ($this->id) {
           
            $stmt = $this->db->prepare(
                "UPDATE characters 
                        SET name = :name, 
                       description = :description, 
                        health = :health, 
                        strength = :strength, 
                        defense = :defense, 
                        image = :image 
                        WHERE id = :id"
            );
            $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        } else {
            
            $stmt = $this->db->prepare(
                "INSERT INTO characters (name, description, health, strength, defense, image) 
                 VALUES (:name, :description, :health, :strength, :defense, :image)"
            );
        }
    
        
        $stmt->bindValue(':name', $this->getName());
        $stmt->bindValue(':description', $this->getDescription());
        $stmt->bindValue(':health', $this->getHealth(), PDO::PARAM_INT);
        $stmt->bindValue(':strength', $this->getStrength(), PDO::PARAM_INT);
        $stmt->bindValue(':defense', $this->getDefense(), PDO::PARAM_INT);
        $stmt->bindValue(':image', $this->getImage());
    
        
        return $stmt->execute();
    }
    
    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     */
    public function setDb($db): self
    {
        $this->db = $db;

        return $this;
    }
    public function loadById($id) {
        $stmt = $this->db->prepare("SELECT * FROM characters WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->health = $data['health'];
            $this->strength = $data['strength'];
            $this->defense = $data['defense'];
            $this->image = $data['image'];
            return true;
        }
        return false; 
    }
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM characters");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //array asociativo
    }
}

