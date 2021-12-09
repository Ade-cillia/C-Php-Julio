<?php //Form for each students ?>
<form action="" method="POST">
    <input type="hidden" name="numStudent" value="<?=$_POST["numStudent"]?>">
    <br/>
    <div>
        <label for="">Classe :</label>
        <input type="text" name="class" value=<?=(isset($_POST["class"]))? $_POST["class"]: "" ?>>
    </div>
    <?php
    for ($i=1; $i <= $_POST["numStudent"] ; $i++) { 
    ?>
        <div>
            <p>Etudiant <?=$i?>:</p>
        </div>
        <div>
            <label for="">Prénom :</label>
            <input type="text" name="allNote[<?=$i?>][name]" value=<?=(isset($_POST["allNote"][$i]))? $_POST["allNote"][$i]["name"]: "" ?>> 
        </div>
        <br/>
        <?php
        if (isset($_POST["allNote"][$i]["note"])) { //For add or not one input [if last input are full]
            $numberInput= count($_POST["allNote"][$i]["note"]); // count number of note of show the same number (+1 if last input is not empty)
            if (!empty(end($_POST["allNote"][$i]["note"])) || end($_POST["allNote"][$i]["note"])==="0" ) {
                $numberInput+=1;
            }
           
        }else{
            $numberInput=1;
        }
        for ($j=1; $j <= $numberInput ; $j++) { 
        ?>
            <div>
                <label for="">Note [<?=$j?>]:</label>
                <input type="number" name="allNote[<?=$i?>][note][<?=$j?>]" step="0.1" value='<?=(isset($_POST["allNote"][$i]["note"][$j]))? $_POST["allNote"][$i]["note"][$j]: "" ?>'>
            </div>
            <br/>
        <?php
        }
        ?>
        <input type="submit" name="addInput" value="Add">
        <br/>
    <?php
    }
    ?>
    <br/>
    <input type="submit" name="subInfoStud">
</form>