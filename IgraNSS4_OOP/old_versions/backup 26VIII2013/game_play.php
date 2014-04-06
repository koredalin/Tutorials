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
  $game->tableExit('game-play');
  echo <<<_END
    <input type="button" id="test_hide" value="Hide All" />
    <input type="button" id="test_show" value="Show All" />
    <input type="button" id="show_pawns" value="Show data" /><br />
    <div id="respond">default</div>
_END;
  $pawns_data=$game->getPawnsData();
  $turn_data=$game->getTurnData();  
  ?>
    <script type="text/javascript">
      var pawns_data=<?php echo json_encode($pawns_data); ?>;
      var turn_data=<?php echo json_encode($turn_data); ?>;
      $(document).ready(function(){
       // hideOldData;
       // showPawns;
      });
    </script>
  <?php
  
  $g=serialize($game);
  file_put_contents('Game_contents/game.obj', $g);
  Game::htmlFooter();



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
   /**/