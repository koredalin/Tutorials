<?php
include_once 'algorithm_functions.php';

function htmlHeader() {
  echo '<br /><br /><hr /><h2>Не се сърди човече!</h2>';
  echo '<hr /><br />';
}

/*

// stat_constr - statistic construct
function stat_constr($players_num, $player1_col) {
  $stat_array=array();
  if ($players_num=='' || $player1_col=='') {
    echo 'Няма въведени играчи!';
    exit;
  }

  for ($i=2; $i<$players_num+1; $i++) {
    $pl_col='player'.$i.'_col';
    $$pl_col=setPlayersCol($player1_col, $i);
  }
//  echo $player2_col.' '.$player3_col.'<br />';
// Позициониране пионките на 4-те играча.
  $stat_array[0][0]=$player1_col;
  $pos=63;
  for ($i=1; $i<5; $i++) {
    $stat_array[0][$i]=$pos;
    $pos++;
  }
  $stat_array[0][5]=1; /*

  $stat_array[1][0]=$player2_col;
  $pos=73;
  for ($i=1; $i<5; $i++) {
    $stat_array[1][$i]=$pos;
    $pos++;
  }
  $stat_array[1][5]=0;

  if (isset($player3_col)) {
    $stat_array[2][0]=$player3_col;
  $pos=83;
  for ($i=1; $i<5; $i++) {
    $stat_array[2][$i]=$pos;
    $pos++;
  }
  $stat_array[2][5]=0;
  }

  if (isset($player4_col)) {
    $stat_array[3][0]=$player4_col;
  $pos=93;
  for ($i=1; $i<5; $i++) {
    $stat_array[3][$i]=$pos;
    $pos++;
  }
  $stat_array[3][5]=0;
  }
// Задаване на първия ход
  $stat_array[0][6]=1;
// Записване стойност зар.
  $stat_array[1][6]=rand(1, 6);
//  var_dump($stat_array);
  return $stat_array;
}
/**/


function setPlayersCol($start_color, $pl_res_num) {
//  echo 'setPlayersCol: '.$start_col.'<br />';
  if ($start_color=='yellow') {
    $right_color='green';
    $top_color='blue';
    $left_color='red';
  }
  else if ($start_color=='green') {
    $right_color='blue';
    $top_color='red';
    $left_color='yellow';
  }
  else if ($start_color=='blue') {
    $right_color='red';
    $top_color='yellow';
    $left_color='green';
  }
  else if ($start_color=='red') {
    $right_color='yellow';
    $top_color='green';
    $left_color='blue';
  }
  if ($pl_res_num==2)
    return $right_color;
  else if ($pl_res_num==3)
    return $top_color;
  else if ($pl_res_num==4)
      return $left_color;
}

function setPlayers() {
  echo '<form action="index2.php" method="post">';
  echo '<br /><b>Въведете броя на играчите и цвета на първия.</b>';
  echo '<table border="1"><tr>';
  echo '</tr>';
  echo '<td><select name="players_num">';
    echo '<option value="2">2 играчи</option>';
    echo '<option value="3">3 играчи</option>';
    echo '<option value="4">4 играчи</option>';
    echo '</select>';
    echo '</td>';
  echo '<td><select name="player1_col">';
    echo '<option value="yellow">жълто</option>';
    echo '<option value="green">зелено</option>';
    echo '<option value="blue">синьо</option>';
    echo '<option value="red">червено</option>';
    echo '</select>';
    echo '</td></tr>';  
  echo '<tr><td colspan="2" align="center">';
  echo '<input type="submit">';
  echo '</td></tr>';
  echo '</table>';
  echo '</form><hr />';
  echo 'Забележка: Компютърът подрежда останалите цветове по реда им на листа.';
}



function newTurn($colors_array) {
$zar=$colors_array[1][6];
     // Връща кой цвят е на ход.
    $rows=count($colors_array);
  for ($t=0; $t<$rows; $t++) {
    if ($colors_array[$t][5]==1) {
      $turn_color=$colors_array[$t][0];
      break;
    }
  }
  $turn_num=$colors_array[0][6];
  if ($turn_color=='yellow')
    $bg_color='Жълтите';
  else if ($turn_color=='green')
    $bg_color='Зелените';
  else if ($turn_color=='blue')
    $bg_color='Сините';
  else if ($turn_color=='red')
    $bg_color='Червените';
  
  // var_dump($colors_array);
  // echo 'turn color: '.$turn_color.'<br />';
    // $zar=rand(1, 6);
  echo '<table border=1 background="pics/back_command.jpg">';
  echo '<tr><td colspan="4">';
  echo 'Играещите цветове са: <br />';
  for ($i=0; $i<$rows; $i++) {
    if ($i<$rows-1) {
      echo $colors_array[$i][0].', ';      
    }
    else {
      echo $colors_array[$i][0].'.';
    }    
  }
  
  echo '</tr><tr>';
  echo '<td>Ход № ';
  echo sprintf("%04d", $turn_num);
  echo '</td>';
  echo '<td><font size="4" color="'.$turn_color.'">'.$bg_color.' са на ход.<br />
        Зар '.$zar.'.</font></td>';
  echo '<td background="pics/1_pawn_'.$turn_color.'.jpg" width="45" height="45"></td>';
  echo '<td background="pics/zar'.$zar.'.jpg" width="43" height="45"align="center"></td></tr>';
  echo '<form action="game_play.php" method="post">';
  echo '<tr><td colspan="4" align="right">Преместете пионка  № ';
    echo '<select name="pawn_num">';
    echo '<option value="1">1</option>';
    echo '<option value="2">2</option>';
    echo '<option value="3">3</option>';
    echo '<option value="4">4</option>';
    echo '</select>';
    echo '<input type="submit" value="Следващ ход"></td>';
  echo '</tr>';
  echo '</table>';
  return $zar;
}



function htmlFooter() {
  echo '</body></html>';
}



?>