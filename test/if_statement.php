<?php

    // PRACTICAL TASK
    $hours = -1;
    $rate = 15;
    $weekly_pay = null;

    if($hours <= 0 ){
        $weekly_pay = 0;

    }

    elseif($hours <= 40){
        $weekly_pay = $hours * $rate;
    }
    else{
        $weekly_pay = ($rate * 40) + (($hours - 40)) * ($rate * 1.5);
    }

    echo "you made {$weekly_pay}GEL this week";


    // EXAMPLE N2
    // $adult = false;

    // if($adult){
    //     echo "you may enter this site";
    // }
    // else{
    //     echo "you must be an adult to enter";
    // }


    // EXAMLE N1
    // $age = 100;

    // if($age >=100){
    //     echo "you are too old to enter this site";
    // }
    // elseif ($age >=18){
    //     echo "you may enter this site";
    // }
    // elseif($age <= 0){
    //     echo "that wasn't a valid age";
    // }
    
    // else{
    //     echo "you must be 18+ to enter"; 
    // }

?>