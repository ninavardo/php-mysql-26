<!-- Form + POST -->
<form method="post">
<input type="number" name="x">
<input type="submit">
</form>

<?php
if(isset($_POST['x'])){
$x = $_POST['x'];
}

?>


<!-- Generate array -->
 <?php  ?>
$arr = [];

for($i=0;$i<12;$i++){
$arr[$i] = rand(10,100);
}; 
?>

<!-- generate matrix -->

for($i=0;$i<4;$i++){
for($j=0;$j<4;$j++){
$m[$i][$j] = rand(10,100);
}
}

<?php 

// statics problem
$sum = 0;
$max = $arr[0];
$min = $arr[0];

for($i=0;$i<count($arr);$i++){

$sum += $arr[$i];

if($arr[$i] > $max)
$max = $arr[$i];

if($arr[$i] < $min)
$min = $arr[$i];

}
?>