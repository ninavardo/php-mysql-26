<?php

    $date = date("l");

    // $date = "weekend";

    switch($date){
      case "Monday":
        echo "i hate mondays";
        break;
      case "Tuesday":
        echo "its taco tuesday";
        break;
      case "Wednesday":
        echo "workday";
        break;
      case "Thursday":
        echo "almost weekend";
        break;
      case "Friday":
        echo "its friday again";
        break;
      case "Saturday":
        echo "time to party";
        break;
      case "Sunday":
        echo "time to relax";
        break;
    default:
        echo "{$date} is not a day";
    }




    // $grade = "A";

    // switch($grade){
    //     case "A":
    //         echo"you did grate";
    //         break;
    //     case "B":
    //         echo"you did good";
    //         break;
    //     case "C":
    //         echo"you did okay";
    //         break;
    //     case "d":
    //         echo"you did poorly";
    //         break;
    //     case "f":
    //         echo"you failed";
    //         break;
    //     default:
    //      echo "{$grade} is not valide";
    // }

?>
