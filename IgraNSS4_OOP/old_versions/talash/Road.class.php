<?php
include_once 'Position.class.php';
class Road{
  private $first;
  private $current;
  private $count;

  private function __construct(){
    $this->count = 0;
    $this->first = null;
    $this->current = null;
  }

  public static function getInstance() {
    if (self::$instance==null) {
      self::$instance=new Road();
    }
    return self::$instance;
  }

  function isEmpty(){
    return ($this->first == NULL);
  }

  function push($data){
    if($this->isEmpty()){
      $this->first   = new Position($data);
      $this->current = $this->first;
      $this->count++;
    }
    else{
      $this->current->link = new Position($data, $this->first);
      $this->current = $this->current->link;
      $this->count++;
    }
  }

  function find($value){
    $q = $this->first;
    while($q->link != null){
      if($q->data == $value)
        $this->current = $q;
      $q = $q->link;
    }
    return false;
  }

  function getNext(){
    $result = $this->current->data;
    $this->current = $this->current->link;
    return $result;
  }

  function fillRoad() {
    $road=new Road();
    /* Позиции 1-14*/
    $road->push('14|8'); $road->push('13|8'); $road->push('12|8'); $road->push('11|8');
    $road->push('10|8'); $road->push('9|8'); $road->push('9|9'); $road->push('8|9');
    $road->push('8|10'); $road->push('8|11'); $road->push('8|12'); $road->push('8|13');
    $road->push('8|14'); $road->push('7|14');
/* Позиции 15-28*/
    $road->push('6|14'); $road->push('6|13'); $road->push('6|12'); $road->push('6|11');
    $road->push('6|10'); $road->push('6|9'); $road->push('5|9'); $road->push('5|8');
    $road->push('4|8'); $road->push('3|8'); $road->push('2|8'); $road->push('1|8');
    $road->push('0|8'); $road->push('0|7');
/* Позиции 29-42*/
    $road->push('0|6'); $road->push('1|6'); $road->push('2|6'); $road->push('3|6');
    $road->push('4|6'); $road->push('5|6'); $road->push('5|5'); $road->push('6|5');
    $road->push('6|4'); $road->push('6|3'); $road->push('6|2'); $road->push('6|1');
    $road->push('6|0'); $road->push('7|0');
/* Позиции 43-56*/
    $road->push('8|0'); $road->push('8|1'); $road->push('8|2'); $road->push('8|3');
    $road->push('8|4'); $road->push('8|5'); $road->push('9|5'); $road->push('9|6');
    $road->push('10|6'); $road->push('11|6'); $road->push('12|6'); $road->push('13|6');
    $road->push('14|6'); $road->push('14|7');
  }
}

/*


  /**/