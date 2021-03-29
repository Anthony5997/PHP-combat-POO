<?php
    require("class/Autoloader.php");
    Autoloader::register();
    require("partials/sql_connect.php");
    require("partials/header.php");


    if(isset($_SESSION['connect'])){

    if(isset($_POST["create"])){
        $carac1 = new Character($_POST);
        $caracManage1 = new CharacterManager($bdd);
        if($caracManage1->characterExist($carac1) === true){

          $caracManage1->createCharacter($carac1);
            echo "Perso créé";
            
        }else{
            echo "Le personnage existe déjà";
        }
    }else{
        echo "Personnage connecter";
        $caracManage1 = new CharacterManager($bdd);
        if (empty($_SESSION['perso'])) {   
            $perso = $caracManage1->getCharacter(empty($_POST['select-character']) ? session_unset() : $_POST['select-character']);
        }else{
            $perso = $_SESSION['perso'];
        }
        include("combat.php");
    }
}else{
    $caracManage1 = new CharacterManager($bdd);
    $perso = $caracManage1->getCharacter(empty($_POST['select-character']) ? "" : $_POST['select-character']);
    ?>
    <div class="container">
        <div class="row">
            <h2>Crée un nouveau personnage</h2>
            <div class="col-6">
                <form action="#" method="post">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" name="name" maxlength="50" id="nom" class="form-control" />
                        </div>
                        <input type="hidden" name="damages" maxlength="50" id="degat" class="form-control" value="<?=rand(6, 25)?>"/>
                        <input type="hidden" name="strength" maxlength="50" id="vie" class="form-control" value="<?=rand(30, 225)?>"/>
                        <div class="form-group">
                            <label for="nom">Classe</label>
                            <select class="form-select" class="select-class" name="class" id="select-class">
                                <option name="warrior" value="warrior">Guerrier</option>
                                <option name="archer" value="archer">Archer</option>
                                <option name="wizard" value="wizard">Magicien</option>
                            </select>
                        </div>
                    </div>
                    <input class="btn btn-outline-secondary" type="submit" value="Créer ce personnage" name="create"/>
                </form>
            </div>
            <div class="col-sm-6">
                <h2>Selectionné un personnage existant</h2>
                <div class="col-sm-6">
                    <form action="#" method="post">
                        <select class="form-select" name="select-character" id="select-character">
                            <option selected>Selectionner un combattant</option>
                        <?php
                            foreach($caracManage1->getAll() as $characterSelect){
                                echo '<option name='.$characterSelect->getName().' value='.$characterSelect->getName().'>'.$characterSelect->getName(). '</option>';
                            }
                        ?>  
                        </select>
                        <input class="btn btn-outline-secondary" type="submit" value="Choisir ce personnage" name="use"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    }
    require("partials/footer.php");
?>