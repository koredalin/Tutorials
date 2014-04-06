<?php
class Dice{
  private $value;

  public function __construct() {
    $this->value=rand(1, 6);
  }

  public function throwDice() {
    $this->value=rand(1,6);
    return $this->value;
  }

  public function value() {
    return $this->value;
  }

  public function render() {
    return '<img src="/pics/zar'.$this->value.'.jpg" alt="'.$this->value.'">';
  }
}