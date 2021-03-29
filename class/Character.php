<?php

class Character{
    
    private $name;
    private $damages;
    private $class;
    private $strength;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        $this->name = $data['id'];
        $this->name = $data['name'];
        $this->damages = $data['damages'];
        $this->class = $data['class'];
        $this->strength = $data['strength'];
    }
        
    public function getId()
    {
        return $this->id;
    }
    
    public function getName()
    {
        return $this->name;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function getDamages()
    {
        return $this->damages;
    }


    public function setDegats($damages)
    {
        $damages = (int) $damages;
    
        if($damages >= 0 && $damages <= 100)
        {
            $this->damages = $damages;
        }
    }
  
    public function setName($name)
    {
        if(is_string($name))
        {
        $this->name = $name;
        }
    }

    public function frapper(Character $perso)
    {
      if ($perso->name == $this->name)
      {
        return "AAAH";
      }
      
      
      // On indique au personnage qu'il doit recevoir des dégâts.
      // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE.
      return $perso->getHit();
    }

    public function getHit(Character $whoHit)
    {
      $this->strength = $this->strength - $whoHit->getDamages();
      
    }

}