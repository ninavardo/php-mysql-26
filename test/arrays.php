<?php

$foods = array('apple', 'orange', 'banana', 'coconut');

// $foods[0] = "pineaple"; ელემენტის ჩანაცვლება
// array_push($foods, 'pineaple', 'kiwi'); ჩამონათვალში ჩამატაება
// array_pop($foods); ბოლო ელემენტის გაქრობა
// array_shift($foods); pirveli elementis amoshla
// $foods = array_reverse($foods); shebruneba(win saxeli unda davuwerot uechveli)
// echo count($foods); array-is elementebis raodenobis datvla

foreach($foods  as $food){
    echo $food . "<br>";
}

?>