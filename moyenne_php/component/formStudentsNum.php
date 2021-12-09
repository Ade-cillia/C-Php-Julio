<?php //Form for number students?>
<form action="" method="POST">
    <div>
        <h1>Formulaire:</h1>
    </div>
    <div>
        <label for="numStudent">Nombre d'étudiant :</label>
        <br/>
        <input type="number" id="numStudent" name="numStudent" place_holder="nombre d'étudiant" value='<?= (isset($_POST["numStudent"]))? $_POST["numStudent"]: "" ?>'>
        <br/><br/>
    </div>
    <div>
        <input type="submit" value="Change" name="subNumStud">
    </div>
</form>
    