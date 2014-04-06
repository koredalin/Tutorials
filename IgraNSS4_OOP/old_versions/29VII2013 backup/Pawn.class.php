<?php
class Pawn{
  private $color;
  private $position;
  private $number;


  public function __construct($color, $number, &$pos_link){
    $this->color=$color;
    $this->position=$pos_link;
    $this->number=$number;
  }

  public function newPosition(&$new_pos) {
    $this->position=$new_pos;
  }

  public function render() {
    $render=$this->number;
  //  $render='<span style="font-weight:bold">'.$this->number.'</span>';
    return $render;
  }

  public function getColor() {
      return $this->color;
  }
}

    /* $render='<td background="pics/'.$pp_num.'_pawns_'.$this->color.'.jpg"
                                width="45" height="45" align="center"><b>'.$pawn_numbers.'</b></td>'; /**/