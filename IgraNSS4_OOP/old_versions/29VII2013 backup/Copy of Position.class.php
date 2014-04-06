<?php
class Position {
  public $data;
  public $link;

  function __construct($data, $next = NULL){
    $this->data = $data;
    $this->link = $next;
  }
}



/*
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