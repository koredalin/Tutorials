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
    return '<span style="color:'.$this->name.';font-size:16pt;font-weight:bold">'.$this->name.'</span>';
  }

  public function isMyPawn($pawn_ref){
    foreach($this->pawns_ref as $ref)
      if ($ref==$pawn_ref)
        return true;
    return FALSE;
  }

}

/*
 *
 *
 * protected $pawn=array(0, 0, 0, 0);
 *  public function  __construct($game_colors, $players_num, $pos_link) {
    $this->count=0;
    for ($i=0; $i<$players_num; $i++) {
      for ($j=1; $j<5; $j++) {
        $this->color=$pg1->game_colors[$i];
        $this->link=$pos_link;
        $this->count++;
      }
    }
  }

 */