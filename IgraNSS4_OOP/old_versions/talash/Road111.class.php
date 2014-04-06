<?php
include_once 'Position.class.php';
class Road{
  private $first;
  private $last;
  private $count;
  private $links;

  function __construct(){
    $this->count = 0;
    $this->first = null;
    $this->last = null;
  }

  function isEmpty(){
    return ($this->first == NULL);
  }

  function push($x, $y, $color, $type, $pawns){
    if($this->isEmpty()){
      $this->first = new Position($x, $y, $color, $type, $pawns);
      $this->last = &$this->first;
      $this->links = $this->last;
      $this->count++;
    }
    else{
      $this->last->link = new Position($x, $y, $color, $type, $pawns, $this->first);
      $this->last = &$this->last->link;
      $this->links = $this->last;
      $this->count++;
    }
  }

  public function getElement($array_number) {
    $result[]=$this->links[$array_number]->x;
    $result[]=$this->links[$array_number]->y;
    $result[]=$this->links[$array_number]->color;
    $result[]=$this->links[$array_number]->type;
    $result[]=$this->links[$array_number]->pawns;
    return $result;
  }


  function getNext(){
    $this->last = $this->last->link;
    $result[] = $this->last->x;
    $result[] = $this->last->y;
    $result[] = $this->last->color;
    $result[] = $this->last->type;
    $result[] = $this->last->pawns;
    return $result;
  }

  public function render() {    
    if (!empty($this->last->pawns)) {
      $p_c=count($this->last->pawns); // pawns count
      $rend=$this->last->render();
      $col=$this->last->pawns[0]->color;
      $img='<img src="'.$col.'_pawn.png">';
      if ($p_c==1){
        $rend='<div class="d_11">
	         <img class="i1" src="'.$col.'_pawn.png">'.
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

}


/*
 *
 *
 *
  // static private $instance=null;
  private $first;
  private $last;
  private $count;

  public function __construct(){
    $this->count = 0;
    $this->first = null;
    $this->last = null;
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
        $this->last->link = new Position($data, $this->first);
        $this->last = $this->last->link;
        $this->count++;
    }
  }

    public function getNextRoad(){
    $result = $this->last->data;
    /* $result[] = $road->last->x;
    $result[] = $road->last->y;
    $result[] = $road->last->color;
    $result[] = $road->last->type;
//    $result = $road->$last->data; /*
    $this->last = $this->last->link;
    return $result;
  }

 public static function getInstance() {
    if (self::$instance==null) {
      self::$instance=new Road();
    }
    return self::$instance;
  } /*

 *
 *
 * function find($value){

    $q = self::$first;
    while($q->link != null){
      if($q->data == $value)
          self::$last = $q;
      $q = $q->link;
    }
    return false;
  } /**/
  /**/


  /*
  function find($col, $typ){
    $q = $this->first;
    while($q->link != null){
      if($q->color == $col && $q->type==$typ)
        $this->last = $q;
      $q = $q->link;
    }
    return false;
  } /**/