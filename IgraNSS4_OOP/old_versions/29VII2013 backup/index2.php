<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
<?php
include_once 'Game.class.php';
include_once 'Dice.class.php';
include_once 'Pawn.class.php';
include_once 'Player.class.php';
include_once 'Playground.class.php';
include_once 'Position.class.php';
include_once 'Road.class.php';
// include_once 'Functions.php';

$players_num=isset($_POST['players_num'])?$_POST['players_num']:'';
$player1_col=isset($_POST['player1_col'])?$_POST['player1_col']:'';

$col=PlayGround::setGameColors($player1_col);
for ($i=0; $i<count($col); $i++){
  echo $col[$i].' | ';
}
?>