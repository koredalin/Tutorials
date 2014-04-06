<?php
class Pawn{
  private $color;
  private $pos_num;
  private $number;
  private $home_pos_num;


  public function __construct($color, $number, $pos_num=0){
    $this->color=$color;
    $this->pos_num=$pos_num;
    $this->number=$number;
  }

  public function newPosition($new_pos) {
    $this->pos_num=$new_pos;
  }
  
  public function setHomePosNum($pos_num) {
    $this->home_pos_num=$pos_num;
  }
  
  public function gotoHomePos() {
    $this->pos_num=  $this->home_pos_num;
    return $this->pos_num;
  }

  public function render() {
    $render=$this->number;
  //  $render='<span style="font-weight:bold">'.$this->number.'</span>';
    return $render;
  }

  public function getColor() {
      return $this->color;
  }
  
    public function getNumber() {
      return $this->number;
  }
  
  public function getPosition(){
    return $this->pos_num;
  }

  public function getHome(){
    return $this->home_pos_num;
  }
}

    /* $render='<td background="pics/'.$pp_num.'_pawns_'.$this->color.'.jpg"
                                width="45" height="45" align="center"><b>'.$pawn_numbers.'</b></td>'; /**/