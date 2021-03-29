<?php

class CharacterManager{

    private $pdo;

    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function createCharacter($character){

        $CharacterStatement = $this->pdo->prepare("INSERT INTO characters (name, damages, class, strength) VALUE (:name, :damages, :class, :strength)");
        $CharacterStatement->bindValue("name", $character->getName(), PDO::PARAM_STR);
        $CharacterStatement->bindValue("damages", $character->getDamages(), PDO::PARAM_STR);
        $CharacterStatement->bindValue("class", $character->getClass(), PDO::PARAM_STR);
        $CharacterStatement->bindValue("strength", $character->getStrength(), PDO::PARAM_STR);
        $CharacterStatement->execute();
        $persoCreated = (int)$this->pdo->lastInsertId();
        var_dump("ID DU DERNIER PERSO CREE",$persoCreated);
        $perso = $this->getCharacter($persoCreated);
        var_dump("PERSO CREE EN OBJET",$perso);
        $_SESSION['connect'] = 1;
        $_SESSION['perso'] = $perso;

    }

    public function getCharacter($info)
    {
      if (is_int($info))
      {
        $CharacterStatement = $this->pdo->query('SELECT id, name, damages, strength FROM characters WHERE id = '.$info);
       return $CharacterSelected = $CharacterStatement->fetch(PDO::FETCH_ASSOC);
      }
      
      else{

        $persos = [];
        $CharacterStatement = $this->pdo->prepare('SELECT id, name, damages, class, strength FROM characters WHERE name = :name');
        $CharacterStatement->execute([':name' => $info]);

        while ($CharacterSelected = $CharacterStatement->fetch(PDO::FETCH_ASSOC))
        {
          switch ($CharacterSelected['class'])
          {
            case 'warrior': $persos = new Warrior($CharacterSelected); break;
            case 'wizard': $persos = new Wizard($CharacterSelected); break;
            case 'archer': $persos = new Archer($CharacterSelected); break;
          }
        }
        $_SESSION['connect'] = 1;
        $_SESSION['perso'] = $persos;
        return $persos;
      }
    }
    

    public function getAll(){
        $CharacterStatement = $this->pdo->prepare("SELECT * FROM characters");
        $CharacterStatement->execute();

        $characterRow = $CharacterStatement->fetchAll(PDO::FETCH_ASSOC);
        $allCharactersList = array();

        foreach($characterRow as $character){

            array_push($allCharactersList, new Character($character));
        }
        return $allCharactersList;
    }

    public function characterExist($character){
        $CharacterStatement = $this->pdo->prepare("SELECT COUNT(*) FROM characters WHERE name = ?");
        $CharacterStatement->execute([
            $character->getName()
        ]);
        $result = empty($CharacterStatement->fetchColumn());
        return (bool) $result;
    }

    public function deleteCharacter($character){
        $CharacterStatement = $this->pdo->prepare("DELETE FROM characters WHERE name = ?");
        $CharacterStatement->execute([
            $character->getName()
        ]);
    }

    public function update(Character $perso)
    {
      $q = $this->pdo->prepare('UPDATE characters SET strength = :strength WHERE name = :name');
      
      $q->bindValue(':strength', $perso->getStrength(), PDO::PARAM_INT);
      $q->bindValue(':name', $perso->getName(), PDO::PARAM_STR);
      
      $q->execute();
    }

    public function getNbrOfCharacter(){
        $CharacterStatement = $this->pdo->prepare("SELECT COUNT(*) FROM characters");
        $nbrCharacter = $CharacterStatement->execute();
        return $nbrCharacter;
    }
}