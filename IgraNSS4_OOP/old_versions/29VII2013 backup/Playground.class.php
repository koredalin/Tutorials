<?php
include_once 'Road.class.php';
include_once 'Position.class.php';
class Playground{
  // static private $instance=null;
  public $game_colors;
  private $first;
  private $last;
  private $count;
  public $road;

  public function  __construct() {
    $this->count = 0;
    $this->first = null;
    $this->last = null;
    $this->road = new Road();
    $this->setGameColors();
  }

  public function setGameColors($ex=''){
      $first_color='red'; // za proba
    $new_colors=array();
    $var1=array('blue', 'red', 'yellow', 'green');
    $var2=array('red', 'yellow', 'green', 'blue');
    $var3=array('yellow', 'green', 'blue', 'red');
    $var4=array('green', 'blue', 'red', 'yellow');
    if ($first_color=='blue') {
        if ($ex=='out')
          return $var1;
        else
          $this->game_colors=$var1;
    }
    if ($first_color=='red') {
        if ($ex=='out')
          return $var2;
        else
          $this->game_colors=$var2;
    }
    if ($first_color=='yellow') {
        if ($ex=='out')
          return $var3;
        else
          $this->game_colors=$var3;
    }
    if ($first_color=='green') {
        if ($ex=='out')
          return $var4;
        else
          $this->game_colors=$var4;
    }
  }

  public function fillPlaygroundRoad() {
    $this->roadPositions();
    $this->specialPositions();
    $this->decorationPositions();
  }

  private function isEmpty(){
    return ($this->first == NULL);
  }

  public function push($data){
    if($this->isEmpty()){
      $this->first   = new Position($data);
      $this->last = $this->first;
      $this->count++;
    }
    else{
      $this->last->link = new Position($data, $this->first); // , $this->first); // , ($this->count)+1
      $this->last = $this->last->link;
      $this->count++;
    }
  }

  public function getNext(){
      $result = $this->last->data;
/*    $result[] = $this->last->link->x;
    $result[] = $this->last->link->y;
    $result[] = $this->last->link->color;
    $result[] = $this->last->link->type; /**/
    $this->last = $this->last->link;
    return $result;
  }


  private function specialPositions() {
    $pc=$this->game_colors;
    $s_pos=array(
    // final color0
    array(13, 7, $pc[0], 'f'), array(12, 7, $pc[0], 'f'), // f - final
    array(11, 7, $pc[0], 'f'), array(10, 7, $pc[0], 'f'),
    array(9, 7, $pc[0], 'f'), array(8, 7, $pc[0], 'gf'), // gf - grand final
    // begin color0
    // bp1-4 - begin position pawn number
    array(11, 1, $pc[0], 'bp1'), array(11, 3, $pc[0], 'bp2'),
    array(13, 1, $pc[0], 'bp3'), array(13, 3, $pc[0], 'bp4'),
    // final color1
    array(7, 13, $pc[1], 'f'), array(7, 12, $pc[1], 'f'),
    array(7, 11, $pc[1], 'f'), array(7, 10, $pc[1], 'f'),
    array(7, 9, $pc[1], 'f'), array(7, 8, $pc[1], 'gf'),
    // begin color1
    array(11, 11, $pc[1], 'bp1'), array(11, 13, $pc[1], 'bp2'),
    array(13, 11, $pc[1], 'bp3'), array(13, 13, $pc[1], 'bp4'),
    // final color2
    array(1, 7, $pc[2], 'f'), array(2, 7, $pc[2], 'f'),
    array(3, 7, $pc[2], 'f'), array(4, 7, $pc[2], 'f'),
    array(5, 7, $pc[2], 'f'), array(6, 7, $pc[2], 'gf'),
    // begin color2
    array(1, 11, $pc[2], 'bp1'), array(1, 13, $pc[2], 'bp2'),
    array(3, 11, $pc[2], 'bp3'), array(3, 13, $pc[2], 'bp4'),
    // final color3
    array(7, 1, $pc[3], 'f'), array(7, 2, $pc[3], 'f'),
    array(7, 3, $pc[3], 'f'), array(7, 4, $pc[3], 'f'),
    array(7, 5, $pc[3], 'f'), array(7, 6, $pc[3], 'f'),
    // begin color3
    array(1, 1, $pc[3], 'bp1'), array(1, 3, $pc[3], 'bp2'),
    array(3, 1, $pc[3], 'bp3'), array(3, 3, $pc[3], 'bp4'),
    );
    foreach($s_pos as $elem)
      $this->push($elem);
      // $this->push($elem[0], $elem[1], $elem[2], $elem[3]);
   /*   */
  }

  private function decorationPositions() {
    $dec_pos=array(
      array(12, 2, '-', 'dec2'), array(12, 12, '-', 'dec2'),
      array(2, 12, '-', 'dec2'), array(2, 2, '-', 'dec2'),
      array(7, 7, '-', 'dec1'));
    foreach($dec_pos as $elem)
      $this->push($elem);
      // $this->push($elem[0], $elem[1], $elem[2], $elem[3]);
  }

  private function roadPositions() {
    $pc=$this->game_colors; // $pc - position colors
    /* Позиции 1-14*/
    //s1 & s2 - start color0
    $r_ar=array(
            array(14, 8, $pc[0], 's1'), array(13, 8, $pc[0], 's2'), array(12, 8, '-', '-'), array(11, 8, '-', '-'),
            array(10, 8, '-', '-'), array(9, 8, '-', '-'), array(9, 9, '-', '-'), array(8, 9, '-', '-'),
            array(8, 10, '-', '-'), array(8, 11, '-', '-'), array(8, 12, '-', '-'), array(8, 13, '-', '-'),
            array(8, 14, '-', '-'), array(7, 14, $pc[1], 'e'), // e - exit color1
/* Позиции 15-28*/
            array(6, 14, $pc[1], 's1'), array(6, 13, $pc[1], 's2'), array(6, 12, '-', '-'), array(6, 11, '-', '-'),
            array(6, 10, '-', '-'), array(6, 9, '-', '-'), array(5, 9, '-', '-'), array(5, 8, '-', '-'),
            array(4, 8, '-', '-'), array(3, 8, '-', '-'), array(2, 8, '-', '-'), array(1, 8, '-', '-'),
            array(0, 8, '-', '-'), array(0,7, $pc[2], 'e'),
/* Позиции 29-42*/
            array(0, 6, $pc[2], 's1'), array(1, 6, $pc[2], 's2'), array(2, 6, '-', '-'), array(3, 6, '-', '-'),
            array(4, 6, '-', '-'), array(5, 6, '-', '-'), array(5, 5, '-', '-'), array(6, 5, '-', '-'),
            array(6, 4, '-', '-'), array(6, 3, '-', '-'), array(6, 2, '-', '-'), array(6, 1, '-', '-'),
            array(6, 0, '-', '-'), array(7, 0, $pc[3], 'e'),
/* Позиции 43-56*/
            array(8, 0, $pc[3], 's1'), array(8, 1, $pc[3], 's2'), array(8, 2, '-', '-'), array(8, 3, '-', '-'),
            array(8, 4, '-', '-'), array(8, 5, '-', '-'), array(9, 5, '-', '-'), array(9, 6, '-', '-'),
            array(10, 6, '-', '-'), array(11, 6, '-', '-'), array(12, 6, '-', '-'), array(13, 6, '-', '-'),
            array(14, 6, '-', '-'), array(14, 7, $pc[0], 'e'),
    );
    foreach ($r_ar as $elem)
      $this->road->push($elem);
      // $this->road->push($elem[0], $elem[1], $elem[2], $elem[3]);
  //  var_dump($this->road);
  }

  function setPlayground() {
    $gc=$this->game_colors;
    $showall_array=array();
    for ($i=0; $i<15; $i++) {
      for ($j=0; $j<15; $j++) {
        $showall_array[$i][$j]='<td width="45" height="45"></td>';
      }
    }
    
    $cell=array(); // show cell
    for ($i=0; $i<45; $i++){
      $ca[]=$this->getNext();
    }
    for ($i=0; $i<56; $i++) {
      $ca[]= $this->road->getNextRoad();
    }
    foreach ($ca as $cell) {
//      print_r($cell);

    if (($cell[2]=='-' && $cell[3]=='-') || $cell[3]=='e') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/empty_play.jpg" width="45" height="45"></td>';
    }
    if ($cell[3]=='dec1') {
    $showall_array[$cell[0]][$cell[1]]='<td background="pics/trophy.jpg" width="45" height="45"></td>';
    }
    if ($cell[3]=='dec2') {
    $showall_array[$cell[0]][$cell[1]]='<td background="pics/start_fire.jpg" width="45" height="45"></td>';
    }
    if ($cell[3]=='bp1' || $cell[3]=='bp2' || $cell[3]=='bp3' || $cell[3]=='bp4') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/start_empty_'.$cell[2].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[3]=='f') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/final_'.$cell[2].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[3]=='gf') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/grand_final_'.$cell[2].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[0] && $cell[3]=='s1') { // player1
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_up_arrow_'.$gc[0].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[0] && $cell[3]=='s2') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_up_arrow_'.$gc[0].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[1] && $cell[3]=='s1') { // player2
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_left_arrow_'.$gc[1].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[1] && $cell[3]=='s2') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_left_arrow_'.$gc[1].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[2] && $cell[3]=='s1') { // player3
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_down_arrow_'.$gc[2].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[2] && $cell[3]=='s2') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_down_arrow_'.$gc[2].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[3] && $cell[3]=='s1') { // player4
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_right_arrow_'.$gc[3].'.jpg" width="45" height="45"></td>';
    }
    if ($cell[2]==$gc[3] && $cell[3]=='s2') {
      $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_right_arrow_'.$gc[3].'.jpg" width="45" height="45"></td>';
    }

    }
    return $showall_array;
  } /**/





}


/*

for ($i=0; $i<15; $i++) {
      echo '<tr>';
      for ($j=0; $j<15; $j++) {
        echo $show_array[$i][$j];
      }
      echo '</tr>';
    }

foreach ($r_ar as $row) {
      foreach ($row as $element)
        $this->road->push($element[0], $element[1], $element[2], $element[3]);
    }
  public static function getInstance() {
    if (self::$instance==null) {
      self::$instance=new Playground();
    }
    return self::$instance;
  }
 *
 *    /* Позиции 1-14
    //s1 & s2 - start color0
    $this->road->push(14, 8, $pc[0], 's1'); $this->road->push(13, 8, $pc[0], 's2'); $this->road->push(12, 8, '', ''); $this->road->push(11, 8, '', '');
    $this->road->push(10, 8, '', ''); $this->road->push(9, 8, '', ''); $this->road->push(9, 9, '', ''); $this->road->push(8, 9, '', '');
    $this->road->push(8, 10, '', ''); $this->road->push(8, 11, '', ''); $this->road->push(8, 12, '', ''); $this->road->push(8, 13, '', '');
    $this->road->push(8, 14, '', ''); $this->road->push(7, 14, $pc[1], 'e'); // e - exit color1
    var_dump($this->road);
/* Позиции 15-28
    $this->road->push(6, 14, $pc[1], 's1'); $this->road->push(6, 13, $pc[1], 's2'); $this->road->push(6, 12, '', ''); $this->road->push(6, 11, '', '');
    $this->road->push(6, 10, '', ''); $this->road->push(6, 9, '', ''); $this->road->push(5, 9, '', ''); $this->road->push(5, 8, '', '');
    $this->road->push(4, 8, '', ''); $this->road->push(3, 8, '', ''); $this->road->push(2, 8, '', ''); $this->road->push(1, 8, '', '');
    $this->road->push(0, 8, '', ''); $this->road->push(0,7, $pc[2], 'e');
/* Позиции 29-42
    $this->road->push(0, 6, $pc[2], 's1'); $this->road->push(1, 6, $pc[2], 's2'); $this->road->push(2, 6, '', ''); $this->road->push(3, 6, '', '');
    $this->road->push(4, 6, '', ''); $this->road->push(5, 6, '', ''); $this->road->push(5, 5, '', ''); $this->road->push(6, 5, '', '');
    $this->road->push(6, 4, '', ''); $this->road->push(6, 3, '', ''); $this->road->push(6, 2, '', ''); $this->road->push(6, 1, '', '');
    $this->road->push(6, 0, '', ''); $this->road->push(7, 0, $pc[3], 'e');
/* Позиции 43-56
    $this->road->push(8, 0, $pc[3], 's1'); $this->road->push(8, 1, $pc[3], 's2'); $this->road->push(8, 2, '', ''); $this->road->push(8, 3, '', '');
    $this->road->push(8, 4, '', ''); $this->road->push(8, 5, '', ''); $this->road->push(9, 5, '', ''); $this->road->push(9, 6, '', '');
    $this->road->push(10, 6, '', ''); $this->road->push(11, 6, '', ''); $this->road->push(12, 6, '', ''); $this->road->push(13, 6, '', '');
    $this->road->push(14, 6, '', ''); $this->road->push(14, 7, $pc[0], 'e');

/**/