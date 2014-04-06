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
          $text='';
        foreach ($this->pawns as $pawn_ref){          
          $text.=$pawn_ref->render();
          $stringParts = str_split($text);
          sort($stringParts);
          implode('', $stringParts);
        }        
        $text='<div class="d_'.$pawns_count.'2">
                 <span class="s_'.$pawns_count.'">'.$text.'</span>
               </div>';
      }
    return $text;
  }

  public function  setLink($value) {
    $this->link=$value;
  }


  public function getCurrentX() {
    return $this->x;
  }

  public function getCurrentY() {
    return $this->y;
  }

  public function getCurrentColor() {
    return $this->color;
  }

  public function getCurrentType() {
    return $this->type;
  }

  public function getCurrentPawns() {
    return $this->pawns;
  }

  public function getCurrentLink() {
    return $this->link;
  }

  public function removeAllPawns() {
    if (!empty($this->pawns)) {
      $this->pawns=array();
      return true;
    }
    return false;
  }

  public function pushPawn($new_ref) {
    $this->pawns[]=$new_ref;
  }
  
  public function popPawn($rem_ref) {
    // $p_num=array_search($rem_ref, $this->pawns);
    $p_num=-1;
    for ($i=0; $i<count($this->pawns); $i++) {
       if ($rem_ref==$this->pawns[$i]) {
         $p_num=$i;
         // echo 'Pawns in the position count: '.count($this->pawns);
         break;
       }       
    }
    if ($p_num==-1) {
      echo ' The pawn for popping is not found in the old position! <br />';
      return false;
    }
    unset($this->pawns[$p_num]);
    $this->pawns=array_values($this->pawns);
    return true;
  }
  
  public function clearPawns(){
      $this->pawns=array();
  }
}
