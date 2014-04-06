<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Не се сърди човече!</title>
    </head>
    <body>
<?php
include_once 'functions.php';
include_once 'play_functions.php';
include_once 'move_functions.php';
// Зареждане на променливите.
if (!isset($_SESSION['colors_array'])) {
  echo 'Масивът липсва!';
  exit;
}
$colors_array=unserialize($_SESSION['colors_array']);
$pawn_num=isset($_POST['pawn_num'])?$_POST['pawn_num']:'';
//   print_r($colors_array);
// echo '$pawn_num: '.$pawn_num.'<br />';
ob_start();
// try {
  movePawns($colors_array, $pawn_num);
/* if (movePawns($colors_array, $pawn_num)) {
  $colors_array=movePawns($colors_array, $pawn_num);
}  /**/
$show_array=showAllTest($colors_array);
echo '<table><tr><td>';
  echo '<table border="1">';
  for ($i=0; $i<15; $i++) {
    echo '<tr>';
 /*   if ($i==0) {
      echo '<td>X/Y</td>';
      for ($p=0; $p<15; $p++) {
        echo '<td>Y'.$p.'</td>';
      }
      echo '</tr><tr>';
    }
    echo '<td>X'.$i.'</td>'; /**/
    for ($j=0; $j<15; $j++) {
      echo $show_array[$i][$j];
    }
    echo '</tr>';
  }
  echo '</table>';
echo '</td><td valign="top">';
htmlHeader();
$colors_array=setTurnColor($colors_array);
/* }
 catch (Exception $e) {
       ob_end_clean();
// displayErrorPage($e->getMessage());
   echo 'Прихванато изключение: ',  $e->getMessage(), "\n";
 } /**/
 if (isset($ex)) {
     echo $ex;
     echo '<br />Следващият е на ход. <br />';
 }
newTurn($colors_array);
echo '</td></tr></table>';

 //   print_r($colors_array);
// var_dump($colors_array);
//Сериализиране масиви
$_SESSION['colors_array']=serialize($colors_array);
htmlFooter(); /**/
?>