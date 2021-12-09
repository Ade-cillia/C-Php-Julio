<?php
include "./functions.php"; //Import Fonction
include "./pdo/pdo_connection.php"; //Import pdo

echo file_get_contents("./layout/header.html"); //echo head html

$stmt = $pdo->query("SELECT * FROM students");
$students = $stmt->fetchAll();

foreach($students as $key => $value){
    ?>
    <div style="border: 1px solid black; text-align: center;">
        <p>Classe = <?= $value["class"]?></p>
        <p>Nom = <?= $value["firstName"]?></p>
        <p>Note = <?= $value["note"]?></p>
        <p>Moyenne = <?= $value["average"] ?: "Aucunne Note n'est valide" ?></p>
    </div>
    <br>
    <?php
}
echo file_get_contents("./layout/footer.html"); //echo footer