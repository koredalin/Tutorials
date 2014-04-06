<?php
include_once 'Position.class.php';
class Playground{
  private $game_colors;
 // private $pawns;
  private $first;
  private $last;
  private $count;
  private $links;

  public function  __construct($game_colors) {
    $this->count = 0;
    $this->first = null;
    $this->last = null;
    $this->game_colors=$game_colors;
    //$this->pawns=$pawns;
  }

  public function getLinks() {
    return $this->links;
  }

  /* public function fillPlayground() {
    $this->specialPositions();
    $this->decorationPositions();
    $this->roadPositions();
  } /**/

  function isEmpty(){
    return ($this->first == NULL);
  }

  function push($x, $y, $color, $type, $pawns){
    if($this->isEmpty()){
      $this->first = new Position($x, $y, $color, $type, $pawns);
      $this->last = $this->first;
      $this->links[] = $this->last;
      $this->count++;
    }
    else{
      $this->last->setLink(new Position($x, $y, $color, $type, $pawns, $this->first));
      $this->last = $this->last->getCurrentLink();
      $this->links[] = $this->last;
      $this->count++;
    }
  }

  public function getElement($array_number) {
    $result[]=$this->links[$array_number]->getCurrentX();
    $result[]=$this->links[$array_number]->getCurrentY();
    $result[]=$this->links[$array_number]->getCurrentColor();
    $result[]=$this->links[$array_number]->getCurrentType();
    $result[]=$this->links[$array_number]->getCurrentPawns();
    return $result;
  }

  public function render($link) {
    $pawns=$link->getCurrentPawns();
    if (!empty($pawns)) {
      $p_c=count($pawns); // pawns count
      $rend=$link->render();
      $col=$pawns[0]->getColor();
      $img='<img src="pics/'.$col.'_pawn.png">';
      // echo $col.'<br />';
      if ($p_c==1){
        $rend='<div class="d_11">
	         <img class="i1" src="pics/'.$col.'_pawn.png">'.
                 $rend.
               '</div>';
        return $rend;
      }
      if ($p_c==2) {
        $rend='<div class="d_21">'.
                 $img.$img.
                 $rend.
               '</div>';
        return $rend;
      }
      if ($p_c==3) {
        $rend='<div class="d_31">'.
                 $img.'<br />'.
                 $img.$img.
                 $rend.
               '</div>';
        return $rend;
      }
      if ($p_c==4) {
        $rend='<div class="d_41">'.
                 $img.$img.'<br />'.
                 $img.$img.
                 $rend.
               '</div>';
        return $rend;
      }
      if($p_c>4){
        echo 'Too many pawns into the position!<br />';
        echo 'Pawns count: '.$p_c.'.';
        exit;
      }
    }
    else
      return '';
  }

  private function specialPositions() {
    $pc=$this->game_colors;
    $npn=array(); // new pawns null
    $s_pos=array(
    // final color0
    array(13, 7, $pc[0], 'f', $npn), array(12, 7, $pc[0], 'f', $npn), // f - final
    array(11, 7, $pc[0], 'f', $npn), array(10, 7, $pc[0], 'f', $npn),
    array(9, 7, $pc[0], 'f', $npn), array(8, 7, $pc[0], 'gf', $npn), // gf - grand final
    // begin color0
    // bp1-4 - begin position pawn number
    array(11, 1, $pc[0], 'bp1', $npn), array(11, 3, $pc[0], 'bp2', $npn),
    array(13, 1, $pc[0], 'bp3', $npn), array(13, 3, $pc[0], 'bp4', $npn),
    // final color1
    array(7, 13, $pc[1], 'f', $npn), array(7, 12, $pc[1], 'f', $npn),
    array(7, 11, $pc[1], 'f', $npn), array(7, 10, $pc[1], 'f', $npn),
    array(7, 9, $pc[1], 'f', $npn), array(7, 8, $pc[1], 'gf', $npn),
    // begin color1
    array(11, 11, $pc[1], 'bp1', $npn), array(11, 13, $pc[1], 'bp2', $npn),
    array(13, 11, $pc[1], 'bp3', $npn), array(13, 13, $pc[1], 'bp4', $npn),
    // final color2
    array(1, 7, $pc[2], 'f', $npn), array(2, 7, $pc[2], 'f', $npn),
    array(3, 7, $pc[2], 'f', $npn), array(4, 7, $pc[2], 'f', $npn),
    array(5, 7, $pc[2], 'f', $npn), array(6, 7, $pc[2], 'gf', $npn),
    // begin color2
    array(1, 11, $pc[2], 'bp1', $npn), array(1, 13, $pc[2], 'bp2', $npn),
    array(3, 11, $pc[2], 'bp3', $npn), array(3, 13, $pc[2], 'bp4', $npn),
    // final color3
    array(7, 1, $pc[3], 'f', $npn), array(7, 2, $pc[3], 'f', $npn),
    array(7, 3, $pc[3], 'f', $npn), array(7, 4, $pc[3], 'f', $npn),
    array(7, 5, $pc[3], 'f', $npn), array(7, 6, $pc[3], 'gf', $npn),
    // begin color3
    array(1, 1, $pc[3], 'bp1', $npn), array(1, 3, $pc[3], 'bp2', $npn),
    array(3, 1, $pc[3], 'bp3', $npn), array(3, 3, $pc[3], 'bp4', $npn),
    );
    return $s_pos;
  }

  private function decorationPositions() {
    $npn=array(); // new pawns null
    $dec_pos=array(
      array(12, 2, '-', 'dec2', $npn), array(12, 12, '-', 'dec2', $npn),
      array(2, 12, '-', 'dec2', $npn), array(2, 2, '-', 'dec2', $npn));
    return $dec_pos;
  }

  public function roadPositions() {
    $pc=$this->game_colors; // $pc - position colors
    $npn = array(); // new pawns null
    /* Позиции 1-14*/
    //s1 & s2 - start color0
    $r_ar=array(array(7, 7, '-', 'dec1', $npn), // decoration
            array(14, 8, $pc[0], 's1', $npn), array(13, 8, $pc[0], 's2', $npn), array(12, 8, '-', '-', $npn), array(11, 8, '-', '-', $npn),
            array(10, 8, '-', '-', $npn), array(9, 8, '-', '-', $npn), array(9, 9, '-', '-', $npn), array(8, 9, '-', '-', $npn),
            array(8, 10, '-', '-', $npn), array(8, 11, '-', '-', $npn), array(8, 12, '-', '-', $npn), array(8, 13, '-', '-', $npn),
            array(8, 14, '-', '-', $npn), array(7, 14, $pc[1], 'e', $npn), // e - exit color1
/* Позиции 15-28*/
            array(6, 14, $pc[1], 's1', $npn), array(6, 13, $pc[1], 's2', $npn), array(6, 12, '-', '-', $npn), array(6, 11, '-', '-', $npn),
            array(6, 10, '-', '-', $npn), array(6, 9, '-', '-', $npn), array(5, 9, '-', '-', $npn), array(5, 8, '-', '-', $npn),
            array(4, 8, '-', '-', $npn), array(3, 8, '-', '-', $npn), array(2, 8, '-', '-', $npn), array(1, 8, '-', '-', $npn),
            array(0, 8, '-', '-', $npn), array(0,7, $pc[2], 'e', $npn),
/* Позиции 29-42*/
            array(0, 6, $pc[2], 's1', $npn), array(1, 6, $pc[2], 's2', $npn), array(2, 6, '-', '-', $npn), array(3, 6, '-', '-', $npn),
            array(4, 6, '-', '-', $npn), array(5, 6, '-', '-', $npn), array(5, 5, '-', '-', $npn), array(6, 5, '-', '-', $npn),
            array(6, 4, '-', '-', $npn), array(6, 3, '-', '-', $npn), array(6, 2, '-', '-', $npn), array(6, 1, '-', '-', $npn),
            array(6, 0, '-', '-', $npn), array(7, 0, $pc[3], 'e', $npn),
/* Позиции 43-56*/
            array(8, 0, $pc[3], 's1', $npn), array(8, 1, $pc[3], 's2', $npn), array(8, 2, '-', '-', $npn), array(8, 3, '-', '-', $npn),
            array(8, 4, '-', '-', $npn), array(8, 5, '-', '-', $npn), array(9, 5, '-', '-', $npn), array(9, 6, '-', '-', $npn),
            array(10, 6, '-', '-', $npn), array(11, 6, '-', '-', $npn), array(12, 6, '-', '-', $npn), array(13, 6, '-', '-', $npn),
            array(14, 6, '-', '-', $npn), array(14, 7, $pc[0], 'e', $npn),
    );

    $spec_pos=$this->specialPositions();
    $dec_pos=$this->decorationPositions();
    $r_ar=array_merge($r_ar, $spec_pos);
    $r_ar=array_merge($r_ar, $dec_pos);
// var_dump($r_ar);
    foreach ($r_ar as $elem)
      $this->push($elem[0], $elem[1], $elem[2], $elem[3], $elem[4]);
  // echo 'Links elements count: '.count($this->links);
  }

  public function renderAllPawns() {
    for ($i=0; $i<count($this->links); $i++) {
      $pos[]=$this->getElement($i);
    }
   
    $c=0;
    foreach ($pos as $cell) {
      if (!empty($cell[4])) {
        $p_rend[0]= htmlentities($c);
        $p_rend[0]= stripslashes($p_rend[0]);
        $p_rend[1]= htmlentities($this->render($this->links[$c]));
        $p_rend[1]= stripslashes($p_rend[1]);
        $all_pawns[]=$p_rend;
      }
      $c++;
    }
    return $all_pawns;
  }

  function setPlayground() {
    $gc=$this->game_colors;
    $showall_array=array();
    for ($i=0; $i<15; $i++) {
      for ($j=0; $j<15; $j++) {
        $showall_array[$i][$j]='<td width="45" height="45"></td>';
      }
    }
    
    // $cell=array(); // show cell
    for ($i=0; $i<count($this->links); $i++) {
      $pos[]=$this->getElement($i);
    }
   
    $c=0;
    foreach ($pos as $cell) {
      if (empty($cell[4])) {
        $p_rend='';   // echo 'empty ';
      }
      else {   // echo 'full';
        $p_rend=  $this->render($this->links[$c]);
      }      
      if (($cell[2]=='-' && $cell[3]=='-') || $cell[3]=='e') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/empty_play.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[3]=='dec1') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/trophy.jpg" width="45" height="45"></td>';
      }
      if ($cell[3]=='dec2') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/start_fire.jpg" width="45" height="45"></td>';
      }
      if ($cell[3]=='bp1' || $cell[3]=='bp2' || $cell[3]=='bp3' || $cell[3]=='bp4') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/start_empty_'.$cell[2].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[3]=='f') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/final_'.$cell[2].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[3]=='gf') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/grand_final_'.$cell[2].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[0] && $cell[3]=='s1') { // player1
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_up_arrow_'.$gc[0].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[0] && $cell[3]=='s2') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_up_arrow_'.$gc[0].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[1] && $cell[3]=='s1') { // player2
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_left_arrow_'.$gc[1].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[1] && $cell[3]=='s2') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_left_arrow_'.$gc[1].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[2] && $cell[3]=='s1') { // player3
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_down_arrow_'.$gc[2].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[2] && $cell[3]=='s2') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_down_arrow_'.$gc[2].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[3] && $cell[3]=='s1') { // player4
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/back_right_arrow_'.$gc[3].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      if ($cell[2]==$gc[3] && $cell[3]=='s2') {
        $showall_array[$cell[0]][$cell[1]]='<td background="pics/front_right_arrow_'.$gc[3].'.jpg" id="'.$c.'" width="45" height="45">'.$p_rend.'</td>';
      }
      $c++;
    }
    return $showall_array;
  } /**/


}
