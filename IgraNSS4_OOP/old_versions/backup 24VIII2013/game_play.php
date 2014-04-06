<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link rel="stylesheet" title="ext_CSS" type="text/css" href="ext_CSS.css">
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript" src="calc.js"></script>
    </head>
<?php
  include_once 'Game.class.php';
  $g= file_get_contents('Game_contents/game.obj');
  $game=unserialize($g);
  $p_num= isset($_POST['pawn_num'])?$_POST['pawn_num']:'';
  $game->action($p_num);
  $game->tableExit();
  echo <<<_END
    <input type="button" id="test_hide" value="Hide All" />
    <input type="button" id="test_show" value="Show All" />
    <input type="button" id="test_ajax" value="Show Ajax data" /><br />
    <div id="respond">default</div>
_END;

  $exit_data=$game->getExitData();
  // $exit_data=$exit_data[0];
//  var_dump($exit_data);
  $proba=array(6, 7 , 7, 333, 4, 'mandja');
  // header('Content-type: application/json');
  echo '<div style="visibility:hidden" id="turn_data">'.json_encode($exit_data).'</div>';
  // header('Content-type: text/html');
// $game->writeStat();
  $g=serialize($game);
  file_put_contents('Game_contents/game.obj', $g);
  Game::htmlFooter();

  /*


   /**/