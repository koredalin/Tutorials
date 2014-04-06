<?php session_start();
  include_once 'Game.class.php';
  $g= file_get_contents('Game_contents/game.obj');
  $game=unserialize($g);
  $p_num= isset($_POST['radio'])?$_POST['radio']:'tashkent';

  $game->action($p_num);
  $game->tableExit('game-play');
  $pawns_data=$game->getPawnsData();
  $turn_data=$game->getTurnData();
  $turn_data[2][0]=$p_num;
  $data[]=$pawns_data;
  $data[]=$turn_data;  
  
  $g=serialize($game);
  file_put_contents('Game_contents/game.obj', $g);
  header('Content-type: application/json');
  // echo json_encode($p_num);
  echo json_encode($data);
  // header('Content-type: text/html');
  // Game::htmlFooter();








  /*
  var_dump($turn_data);
var_dump($pawns_data);
  // echo '<div style="visibility:hidden" id="turn_data">'.json_encode($exit_data[0]).'</div>';
  // header('Content-type: application/json');
  // header('Content-type: text/html');
// $game->writeStat();
  // $exit_data=$exit_data[0];
//  var_dump($exit_data);
  $proba=array(6, 7 , 7, 333, 4, 'mandja');
  //$exit_data=$game->getExitData();

   <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Не се сърди човече!</title>
        <!-- <link rel="stylesheet" title="ext_CSS" type="text/css" href="ext_CSS.css">  -->
    </head>
   /**/


  /*
   ?>
  <script type="text/javascript">
  var rad=<?php
   *
  console.log(rad);
  </script>
  <?php
  echo <<<_END
    <input type="button" id="test_hide" value="Hide All" />
    <input type="button" id="ajax_data" value="Get AJAX data" />
    <input type="button" id="show_pawns" value="Show data" /><br />
    <div id="respond">default</div>
_END; /**/

  /*
  ?>
    <script type="text/javascript">
      var pawns_data=<?php echo json_encode($pawns_data); ?>;
      var turn_data=<?php echo json_encode($turn_data); ?>;
      $(document).ready(function(){
       // hideOldData;
       // showPawns;
      });
    </script>
  <?php /**/