<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" title="ext_CSS" type="text/css" href="ext_CSS.css">
    </head>
<?php
include_once 'Game.class.php';
/* include_once 'Dice.class.php';
include_once 'Road.class.php'; /**/
// include_once 'Functions.php';

  $players_num=isset($_POST['players_num'])?$_POST['players_num']:'';
  $player1_col=isset($_POST['player1_col'])?$_POST['player1_col']:'';

  $game=new Game($players_num, $player1_col);
  $game->tableExit();
  // $game->clearStatFile();
  $g=serialize($game);
  file_put_contents('Game_contents/game.obj', $g);
  Game::htmlFooter();
?>