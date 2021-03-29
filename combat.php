<?php
//$perso = $_SESSION['perso'];
//$perso->getName();

var_dump("SESSION PERSO IN COMBAT", $perso);
$characterList = $caracManage1->getAll();
    
    if (empty($characterList))
    {
      echo 'Personne à frapper !';
    }
    
    else
    {
     
        foreach ($characterList as $characterTarget)
        {
          echo '<br><a href="?frapper=', $characterTarget->getName(), '">', htmlspecialchars($characterTarget->getName()), '</a> (dégâts : ', $characterTarget->getDamages(), ' | classe : ', $characterTarget->getClass(),' | vie restante : ', $characterTarget->getStrength(),')';
          
          echo '<br />';
        }
    }

   if (isset($_GET['frapper']))
    {
      if (!isset($perso))
      {
        echo 'Merci de créer un personnage ou de vous identifier.';
      }
      
      else
      {
          $charaHit = $caracManage1->getCharacter($_GET['frapper']);
          $charaHit->getHit($perso);
          //$caracManage1->update($perso);
          $caracManage1->update($charaHit);
        if($charaHit->getStrength() <= 0){
          $caracManage1->deleteCharacter($charaHit);
        }else{
          echo $charaHit->getName(). " a subis " . $perso->getDamages() . "dégats.";
        }
              
      }
    }