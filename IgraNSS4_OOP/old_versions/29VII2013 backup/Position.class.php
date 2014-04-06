<?php
include_once 'Pawn.class.php';
class Position {
  private  $x;
  private  $y;
  private  $color;
  private  $type;
  private  $pawns;
  private  $link;

  function __construct($x, $y, $color, $type, $pawns, $next = NULL){
    $this->x = $x;
    $this->y = $y;
    $this->color = $color;
    $this->type = $type;
    if (is_array($pawns))
      $this->pawns=$pawns;
    else
      $this->pawns=array();
    $this->link = $next;
  }

  public function render() {      
      $pawns_count=count($this->pawns);
      if ($pawns_count==4) {
        $text='<div class="d_'.$pawns_count.'2">
                 <span class="s_41">12</span>
                 <span class="s_42">34</span>
               </div>';
      }
      else {
        foreach ($this->pawns as $pawn_ref)
          $text_ar[]=$pawn_ref->render();
          $text_ar=asort($text_ar);
          $text='';
        foreach ($text_ar as $number)
          $text.=$number;
        $text='<div class="d_'.$pawns_count.'2">
                 <span class="s_'.$pawns_count.'">'.$text.'</span>
               </div>';
      }
    return $text;
  }

  public function getCurrentPawns() {
    return $this->pawns;
  }

  public function removeAllPawns() {
    if (!empty($this->pawns)) {
      $this->pawns=array();
      return true;
    }
    return false;
  }

  public function pushPawn($new_ref) {
    $this->pawns[]=array($new_ref);
  }
  
  public function popPawn($rem_ref) {
    $p_num=array_search($rem_ref, $this->pawns);
    if (!$p_num)
      return false;
    unset($this->pawns[$p_num]);
    $this->pawns=array_values($this->pawns);
    return true;
  }  
}






// <div style="background-image: url(../images/test-background.gif); height: 200px; width: 400px; border: 1px solid black;"> </div>


/*
 *       $pawns_color=$this->pawns[0]->getColor();
 *      $pawns_count=count($this->pawns);
 *   public $data;
 
  public $link;

  function __construct($data, $next = NULL){
    $this->data = $data;
    $this->link = $next;
  }
}




class Position{
  //public $data;
  public $x;
  public $y;
  public $color;
  public $type;
  public $link;

  function __construct($x, $y, $color, $type, $next = NULL){
    $this->x = $x;
    $this->y = $y;
    $this->color = $color;
    $this->type = $type;
    $this->link = $next;
  }

  function showElement() {
    //$el=array(14, 6, '-', '-');
    if ($this->color=='-' && $this->type=='-') {
      $final_value='<td background="pics/empty_play.jpg" width="45" height="45"></td>';
    }
    return $final_value;
  }
}
 *
 */