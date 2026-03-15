<?php

    //example2

    $child = true;
    $senior = false;
    $ticket = null;

    if ($child || $senior) {
        $ticket = 10;
    }
    else{
        $ticket = 15;
    }
    echo" the ticket price is {$ticket}GEL";

    //example 1
    // $age = 12;
    // $citizen = true;

    // if($age >= 18 && !$citizen){
    //     echo"you can vote";
    // }
    // else{
    //     echo"you cannot vote";
    // }


// !(not) operator
// $temp = 25;
// $cloudy = false;
  
//   if($temp < 0 || $temp > 30) {
//     echo "weather is bad.<br>";
//   }
//   else{
//     echo "weather is good.<br>";
//   }
  
//   if(!$cloudy){
//     echo "its sunny.";
//   }
//   else{
//     echo "its cloudy.";
//   }


// || (or) operator
//   $temp = 25;
  
//   if($temp < 0 || $temp > 30) {
//     echo "weather is bad";
//   }
//   else{
//     echo "weather is good";
//   }
 //&&(and) operator
//   $temp = -10;
  
//   if($temp >= 0 && $temp <= 30) {
//     echo "weather is good";
//   }
//   else{
//     echo "weather is bad";
//   }

?>