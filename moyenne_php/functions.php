<?php
// Defining a callback function
function myFilter($var){
    return ($var !== NULL && $var !== FALSE && $var !== "" && is_numeric($var)); // filter for array filter for keep 0 and "0" [not return all null/false/""]
}

// Sum function
function sum($notes){
    $sum = 0;
    foreach($notes as $note){
        if (!empty($note) && is_numeric($note)) { //if not is not null
            $sum+=$note;
        }
    }
    return $sum;
}

// Average function
function average($arr){
    if (!empty($arr)) {
        $sum=sum($arr);
        $count = count(array_filter($arr,"myFilter")); // clear null input for count
        if ($count !=0) {
            return ($sum/$count);
        }else{
            return "Aucunne entré valide";
        }
    }  
}

// Store in Db info
function storeInfo($arrStudents,$arrAverageArr,$generalAverage)
{
    $fp = fopen('lidn.txt', 'w');
    foreach($arrStudents as $key => $value){ // For each students
        $name = $value["name"] ?: "Inconnu";
        fwrite($fp, "Notes de [".$name."] = | ");
        foreach($value["note"] as $note){
            fwrite($fp, $note." | ");
        }
        fwrite($fp, "\nMoyenne de [".$name."] = ".$arrAverageArr[$key]."\n\n");
    }
    
    fwrite($fp, "\nMoyenne général = ".$generalAverage."\n");

    fclose($fp);
}

function minMaxAverage($averageArr){
    $min = $averageArr[1];
    $max = $averageArr[1];
    $minArr[1] = $averageArr[1]; // declare array for if many min/max have same note
    $maxArr[1] = $averageArr[1];
    foreach($averageArr as $key => $average){
        if (!empty($average)) {
            if ($average > $max){
                $maxArr = [];
                $maxArr[$key]=$average;
                $max= $average;
            }else if($average === $max){
                $maxArr[$key]=$max;
            }

            if ($average < $min){
                $minArr = [];
                $minArr[$key]=$average;
                $min= $average;
            }else if($average === $min){
                $minArr[$key]=$average;
            }
        }
    }
    return [
        "min"=>$minArr ,
        "max"=>$maxArr
    ];
}