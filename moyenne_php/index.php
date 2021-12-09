<?php 
include "./functions.php"; //Import Fonction
include "./pdo/pdo_connection.php"; //Import pdo

//var_dump($_POST);

echo file_get_contents("./layout/header.html"); //echo head html
include "./component/formStudentsNum.php"; // echo Form input number students

if (isset($_POST["subNumStud"])) { // If number students are send
    if (intval($_POST["numStudent"]) > 0 ) { 
        include "./component/formStudentsInfo.php"; //show form for input names and notes for each students
    }else{
        echo "<p>Aucun étudiant séléctionné</p>";
    }
} elseif(isset($_POST["addInput"])){ // #refresh the page 
    include "./component/formStudentsInfo.php";
} elseif(isset($_POST["subInfoStud"])){ //Do average
    echo "<br/><br/>";
    $class= ($_POST["class"]) ?: "Inconu";
    echo "Class : ".$class."<br/>"; 
    $allAverageArr = [];
    foreach($_POST["allNote"] as $key => $value){ // For each students
        $name= ($value['name']) ?: "Inconu";
        
        $average = average($value["note"]);
        $allAverageArr[$key] = $average;
        echo "Moyenne de ".$name." = ".$average."<br/>"; 
        
        if (is_string($average)) { //For don't send string in float table in mysql 
            $averageDB = null;
        }else {
            $averageDB = strval($average);
        }

        //db storage
        $stmt = $pdo->prepare("INSERT INTO `students` (`firstName`,`average`,`note`,`class`) VALUES (:firstName,:average,:note,:class);");
        $stmt->bindValue(':firstName',$name, PDO::PARAM_STR);
        $stmt->bindValue(':average',$averageDB, PDO::PARAM_STR);
        $stmt->bindValue(':note',json_encode($value["note"]), PDO::PARAM_STR);
        $stmt->bindValue(':class',$class, PDO::PARAM_STR);
        $stmt->execute();
    }

    
    // General average
    $generalAverage = average($allAverageArr);
    echo "<br/>";
    echo "Moyenne général = ".$generalAverage."<br/>"; 
    storeInfo($_POST["allNote"],$allAverageArr,$generalAverage);
    echo "<br/><br/>";
    $minMaxAverageArr = minMaxAverage($allAverageArr);
    echo "Les élves qui on la plus haute moyenne sont: <br/>"; 
    foreach($minMaxAverageArr["max"] as $key => $note){
        echo "L'élève $key [".$_POST['allNote'][$key]["name"]."] : avec $note <br/>"; 
    }
    echo "<br/>";
    echo "Les élves qui on la plus basse moyenne sont: <br/>"; 
    foreach($minMaxAverageArr["min"] as $key => $note){
        echo "L'élève $key [".$_POST['allNote'][$key]["name"]."] : avec $note <br/>"; 
    }
}
echo '
<br/><br/>
<a href="http://localhost/moyenne_php/show.php">Afficher les étudiants</a>
';

echo file_get_contents("./layout/footer.html"); //echo footer