<?php
class Player{
  private $color;
  private $name;
  private $pawns_ref;
  public function  __construct($color, $name, $pawns_ref) {
      $this->color=$color;
      $this->name=$name;
    if (is_array($pawns_ref)) {
      $this->pawns_ref=$pawns_ref;
    }
    else
      $this->pawns_ref=array();
  }

  public function render() {
    return '<span style="color:'.$this->color.'; font-size:16pt; font-weight:bold">'.$this->name.'</span>';
  }

  public function isMyPawn($pawn_ref){
    foreach($this->pawns_ref as $ref)
      if ($ref==$pawn_ref)
        return true;
    return FALSE;
  }

  public function getPawns(){
    return $this->pawns_ref;
  }

  public function getName() {
      return $this->name;
  }

  public function getColor() {
      return $this->color;
  }
}
