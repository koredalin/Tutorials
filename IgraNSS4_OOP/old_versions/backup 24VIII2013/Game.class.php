<?php
include_once 'Dice.class.php';
include_once 'Pawn.class.php';
include_once 'Player.class.php';
include_once 'Playground.class.php';
class Game{
  private $const;
  private $game_colors;
  private $players;
  private $pawns;
  private $plgr;
  private $links;
  private $dice;
  private $move;
  private $exception;
  private $turn;
  private $exit_data;

  public function __construct($players_count, $pl1_color) {
    if (isset($players_count) && isset($pl1_color)) {
      $this->defineGameConstants();
      $this->setGameColors($pl1_color);
      $this->setPawns($players_count);
      $this->setPlayers($players_count);
      $this->plgr=new Playground($this->game_colors);
      $this->plgr->roadPositions();
      $this->links=$this->plgr->getLinks();
      $this->setStartPawns();
      $this->dice=new Dice();
      $this->move=0;
      $this->exception='';
      $this->turn=-1;
      $this->exit_data=array('', '', '', '', '', '');
    }    
  } /**/
  
  private function defineGameConstants(){
    // definning important positions
    $this->const=array(
        'road_pos_count'=>56,
        'col0home1'=>63, 'col1home1'=>73, 'col2home1'=>83, 'col3home1'=>93,
        'col0start'=>1, 'col1start'=>15, 'col2start'=>29, 'col3start'=>43, 
        'col0exit'=>56, 'col1exit'=>14, 'col2exit'=>28, 'col3exit'=>42, 
        'col0final'=>57, 'col1final'=>67, 'col2final'=>77, 'col3final'=>87, 
        'col0grfinal'=>62, 'col1grfinal'=>72, 'col2grfinal'=>82, 'col3grfinal'=>92, 
        'col0homelast'=>66, 'col1homelast'=>76, 'col2homelast'=>86, 'col3homelast'=>96,
        'col0jump'=>0, 'col1jump'=>52, 'col2jump'=>48, 'col3jump'=>44
        );
  }

  private function calcExitData($radio_check) {
    // Render
    // [0] - all pawns; // [1] - Player name; // [2] - dice;
    // [3] - radio check; // [4] - turn number; // [5] - exceptions;
    $this->exit_data[0]= $this->plgr->renderAllPawns();
    $this->exit_data[1]=$this->players[$this->move]->render();
    $this->exit_data[2]=$this->dice->render();
    $this->exit_data[3]=$radio_check;
    $this->exit_data[4]='<font color="'.$this->game_colors[$this->move].'">'.sprintf("%04d", $this->turn).'</font>';
    $this->exit_data[5]=$this->exception;
  }

  public function getExitData() {
    return $this->exit_data;
  }

  public function getGameConstants() {
    return $this->const;
  }

  public function setStartPawns(){
    $home1=array($this->const['col0home1'], $this->const['col1home1'],
                 $this->const['col2home1'], $this->const['col3home1']);
    $cp=count($this->players);
    $pl_in=array(0, 4, 8, 12); // $pl_in - player index
    for ($pl=0; $pl<$cp; $pl++) {
      for ($i=0; $i<4; $i++) {
       $pawn_num=$i+$pl_in[$pl];
       $this->links[$home1[$pl]+$i]->pushPawn($this->pawns[$pawn_num]);
       $this->pawns[$pawn_num]->newPosition($home1[$pl]+$i);
       $this->pawns[$pawn_num]->setHomePosNum($home1[$pl]+$i);
      }
    }
  }

  private function setPawns($pl_count){
    $cp=count($this->players);
    $pl_in=array(0, 4, 8, 12); // $pl_in - player index
    for ($pl=0; $pl<$pl_count; $pl++) {
      for ($i=0; $i<4; $i++) {
        $this->pawns[]= new Pawn($this->game_colors[$pl], $i+1);
      }
    }   
  }
  
  public function getPawns() {
      return $this->pawns;
  }

  private function setPlayers($pl_count){
    $pl_in=array(0, 4, 8, 12);
    $pl_pawns=array();
    
    for ($pl=0; $pl<$pl_count; $pl++) {
      for ($i=0; $i<4; $i++) {
        $pl_pawns[$i]= $this->pawns[$i+$pl_in[$pl]];
      }
      $pl_name='';
      $pl_n=$pl+1;
      $pl_name.='---Player '.$pl_n.'---';
      $plr[]=new Player($this->game_colors[$pl], $pl_name, $pl_pawns);
    }
    // var_dump($plr);
    $this->players=$plr;

  }

  public function getPlayers() {
      return $this->players;
  }

    public static function htmlHeader() {
    echo '<br /><br /><hr /><p><h2>Не се сърди човече!</h2></p>';
    echo '<hr /><br />';
  }

  public static function showPlayersform() {
    echo '<form action="index2.php" method="post">';
    echo '<br /><b>Въведете броя на играчите и цвета на първия.</b>';
    echo '<table border="1"><tr>';
    echo '</tr>';
    echo '<td><select name="players_num">';
    echo '<option value="2">2 играчи</option>';
    echo '<option value="3">3 играчи</option>';
    echo '<option value="4">4 играчи</option>';
    echo '</select>';
    echo '</td>';
    echo '<td><select name="player1_col">';
    echo '<option value="green">зелено</option>';
    echo '<option value="blue">синьо</option>';
    echo '<option value="red">червено</option>';
    echo '<option value="yellow">жълто</option>';
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit">';
    echo '</td></tr>';
    echo '</table>';
    echo '</form><hr />';
    echo 'Забележка: Компютърът подрежда останалите цветове по реда им на листа.';
  }

  public function setGameColors($first_color){
    $var1=array('blue', 'red', 'yellow', 'green');
    $var2=array('red', 'yellow', 'green', 'blue');
    $var3=array('yellow', 'green', 'blue', 'red');
    $var4=array('green', 'blue', 'red', 'yellow');
    if ($first_color=='blue') {
      $this->game_colors=$var1;
    }
    if ($first_color=='red') {
      $this->game_colors=$var2;
    }
    if ($first_color=='yellow') {
      $this->game_colors=$var3;
    }
    if ($first_color=='green') {
      $this->game_colors=$var4;
    }
  }

  public function getGameColors() {
    return $this->game_colors;
  }
  
  public function tableExit(){
    $this->nextMove();
    // echo 'new_move: '.$this->move.' <br />';
    $this->dice->throwDice();
    $show_array= $this->plgr->setPlayground();
    echo '<table><tr><td>';
    echo '<table border="1" background="pics/back1.jpg">';
    for($i=0; $i<15; $i++) {
      echo '<tr>';
      for($j=0; $j<15; $j++) {
      echo $show_array[$i][$j];
      }
      echo '</tr>';
    }
    echo '</table>';
    echo '</td><td valign="top" style="text-align: left;">';
    self::htmlHeader();
    $this->gameControl();
    echo '</td></tr></table>';
    /* echo 'Player 0';
     var_dump($this->players[0]->getPawns());
     echo '<br /><br />';
     echo 'Player 1';
     var_dump($this->players[1]->getPawns());
     echo '<br /><br />';
     echo 'Pawns';
     var_dump($this->pawns); /**/
  }

  private function turnCount(){
    $this->turn++;
  }

  

  private function gameControl() {
    // echo 'count(this->players): '.count($this->players).'<br />';
    // echo 'move: '.$this->move.'<br />';
    $this->turnCount();
    echo '<table border="1" background="pics/back_command.jpg"><tr><td>';
    echo '<p id="pl_name">'.$this->players[$this->move]->render().'</p>'; // <div style="display:inline">   </div>
    echo '</td><td width="51" height="48" valign="top"><div id="dice">'.$this->dice->render();
    echo '</div></td></tr><tr><td colspan="2">';
    echo '<form action="game_play.php" method=post>';
    $checked=array('checked', '', '', '');
    $gfinal=array($this->const['col0grfinal'], $this->const['col1grfinal'],
                  $this->const['col2grfinal'], $this->const['col3grfinal']);
    $pnm=$this->players[$this->move]->getPawns(); //$pnm pawns next move
    $pawn_num_hp=$gfinal[$this->move];
    for ($i=0; $i<4; $i++) {
      if ($i==3) {
        $checked[$i]='checked';
        break;
      }
      $pawn_num=$pnm[$i]->getPosition();
      if ($pawn_num!=$pawn_num_hp) {
        $checked[$i]='checked';
        break;          
      }
    } /**/
    echo <<<_END
    Move pawn No
    <div id="radio" style="display:inline">
    <input type="radio" name="pawn_num" value="1" $checked[0]> 1 |
    <input type="radio" name="pawn_num" value="2" $checked[1]> 2 |
    <input type="radio" name="pawn_num" value="3" $checked[2]> 3 |
    <input type="radio" name="pawn_num" value="4" $checked[3]> 4 </div>
    </td></tr><tr><td style="text-align:right;" colspan="2">
_END;
    echo 'Turn: <span id="turn_num"><font color="'.$this->game_colors[$this->move].'">'
          .sprintf("%04d", $this->turn).'</font></span>';
    echo '<input type="submit" id="play" value="Следващ ход">';
    echo '</form>';
    echo '</td></tr></table>';
    echo '<p><a href="index1.php">Нова игра</a></p>';
    echo $this->exception;
    $this->calcExitData($checked);
  }
  
  public function action($act_pawn){
    $ex= $this->canmove($act_pawn);
    // echo '$act_pawn: '.$act_pawn.'<br />';
    if (!$ex) {
      $this->moveon($act_pawn);
      $this->exception='';
    }
    else {
      $this->exception=$ex;  
    }
  }
  
  private function nextMove() {
    $dice_val=$this->dice->value();    
    $cp=count($this->players);
    $old_move=  $this->move;
    // echo '$old_move: '.$this->move.'; ';
    // echo 'players count'.$cp.'<br />';    
    if ($dice_val==6) {     
      return $this->move;
    }
    if ($old_move>=($cp-1)){
      $this->move=0;
      return $this->move;   
    }
    if ($old_move<($cp-1)) {
      $this->move++;
      return $this->move;
    }
    // echo 'new_move: '.$this->move.' <br />';
  }

  private function canMove($act_pawn){
    $act_pawns=$this->players[$this->move]->getPawns();
    $pawn_pos_num=$act_pawns[$act_pawn-1]->getPosition();
    $dice=$this->dice->value();
    $gfinal=array($this->const['col0grfinal'], $this->const['col1grfinal'],
                  $this->const['col2grfinal'], $this->const['col3grfinal']);
    $out_values=array($this->const['col0homelast'], $this->const['col1homelast'],
                      $this->const['col2homelast'], $this->const['col3homelast']);

 // Check if the game is over.
    $cp=0;
    for ($pl_num=0; $pl_num<count($this->players); $pl_num++) {
      $pl_pawns[]=$this->players[$pl_num]->getPawns();
      $c=0;
      for($i=0; $i<4; $i++){
        $ppn=$pl_pawns[$pl_num][$i]->getPosition();
        if ($ppn==$gfinal[$pl_num])
          $c++;
      }
      if ($c==4) {        
        $cp++;
      }
    }
    if ($cp== count($this->players)) {
      return '<span class="ex">Играта приключи.<br /><a href="index1.php">Играйте отново</a></span>';
    }
// Check if this player is finished.
    $c=0;
    for($i=0; $i<4; $i++){
      $ppn=$act_pawns[$i]->getPosition();
      if ($ppn==$gfinal[$this->move])
        $c++;
    }
    if ($c==4) {
      return '<span class="ex">Вие сте приключили играта. Поздравления!
              <br />Следващият е на ход.</span>';
    }

    if ($pawn_pos_num>$gfinal[$this->move] && $dice!=6) {
      return '<span class="ex">Нуждаете се от 6-ца.
              <br />Следващият е на ход.</span>';
    }
    
    if ($pawn_pos_num==$gfinal[$this->move]) {
      return '<span class="ex">Тази пионка приключи своя ход!
              <br />Следващият е на ход.</span>';
    }  
    if ($pawn_pos_num<$gfinal[$this->move] &&
      $pawn_pos_num+$dice>$gfinal[$this->move]) {
      return '<span class="ex">Нуждаете се от точен зар!
              <br />Следващият е на ход.</span>';
    }
    
    if ($pawn_pos_num<1 || 
        $pawn_pos_num>$out_values[$this->move]) {
      echo 'The pawn is out of the playground! Position: '.
            $act_pawns[$this->move];
      exit;
    }   
    return '';
  }  
  private function moveon($act_pawn){
    $act_pawns=$this->players[$this->move]->getPawns();
    $old_pos_num=$act_pawns[$act_pawn-1]->getPosition();
    $dice=$this->dice->value();
    
  $road_pos_count= $this->const['road_pos_count'];
  $exit= array($this->const['col0exit'], $this->const['col1exit'],
               $this->const['col2exit'], $this->const['col3exit']);
  $home1= array($this->const['col0home1'], $this->const['col1home1'],
                $this->const['col2home1'], $this->const['col3home1']);
  // $jump - jumps from exit to final1
  $jump=array($this->const['col0jump'], $this->const['col1jump'],
              $this->const['col2jump'], $this->const['col3jump']);
  $start=array($this->const['col0start'], $this->const['col1start'],
               $this->const['col2start'], $this->const['col3start']);
    
  if ($this->move==0) {
    if ($old_pos_num>=$home1[0] && $dice==6) {
      $new_pos_num= $start[0];
    }
    else
      $new_pos_num=$old_pos_num+$dice;
  }

  for ($i=1; $i<4; $i++) {
    if ($this->move==$i) {
      if ($old_pos_num>=$home1[$i] && $dice==6) {
        $new_pos_num= $start[$i];
      }
      else if ($old_pos_num<=$road_pos_count &&  ($old_pos_num+$dice)>$road_pos_count) {
        $new_pos_num=$old_pos_num+$dice-$road_pos_count;
      }
      else if ($old_pos_num<=$exit[$i] && ($old_pos_num+$dice)>$exit[$i]){
        $new_pos_num=$old_pos_num+$dice+$jump[$i];
      }
      else {
      $new_pos_num=$old_pos_num+$dice;
      }
    }
  }
  // echo '$old_pos_num: '.$old_pos_num.'; $new_pos_num: '.$new_pos_num;
  $pos_pawns=$this->links[$new_pos_num]->getCurrentPawns();
  if (!empty($pos_pawns)) {    
    $col_old_pawns=$pos_pawns[0]->getColor();
    if ($col_old_pawns!=$this->game_colors[$this->move]) {    
    $this->links[$new_pos_num]->clearPawns();
    foreach($pos_pawns as $ref){
      $start=$ref->gotoHomePos();
      $this->links[$start]->pushPawn($ref);
      }
    }
  }
  $this->links[$new_pos_num]->pushPawn($act_pawns[$act_pawn-1]);
  $this->links[$old_pos_num]->popPawn($act_pawns[$act_pawn-1]);
  $act_pawns[$act_pawn-1]->newPosition($new_pos_num);
  }

  public static function htmlFooter() {
    echo '</body></html>';
  }

  public function writeStat() {
    for ($i=0; $i<count($this->players); $i++){
      $pl_ref=$this->players[$i];
      $pawns_ref=$pl_ref->getPawns();
      for ($j=0; $j<count($pawns_ref); $j++) {
        $player[]=array(
            'pl_name'=> $pl_ref->getName(),
            'pl_col'=> $pl_ref->getColor(),
            'pawn'.$j.'col'=> $pawns_ref[$j]->getColor(),
            'pawn'.$j.'num'=> $pawns_ref[$j]->getNumber(),
            'pawn'.$j.'hpos'=> $pawns_ref[$j]->getHome(),
            'pawn'.$j.'posnum'=> $pawns_ref[$j]->getPosition()

        );
      }
      $output[]=$player;
      $player=array();
    }
    // echo '$output';
    // var_dump($output);
    $out_text='';
    $out_text.='turn=> '.$this->turn.' start | ';
    $out_text.='on_move=> <font color="'.$this->game_colors[$this->move].'"><b>'.$this->move.'</b></font> | ';
    $out_text.='dice=> '.$this->dice->value().' <br />';
    for ($p=0; $p<count($this->players); $p++) {
    // foreach ($output as $player){
      foreach($output[$p] as $name) {
        foreach ($name as $key =>$value) {
          $is_pn=strstr($key, 'posnum');
          if ($is_pn) {
            if ($value<1 || $value> $this->const['col'.$p.'homelast'] ||
                ($value> $this->const['road_pos_count'] && $value< $this->const['col'.$p.'final'])) {
              $value='<font color="red"><b>'.$value.'</b></font>';
              echo $this->const['col'.$p.'homelast'].'<br />';
            }
          }
          if ($value=='red' || $value=='blue' || $value=='green' || $value=='yellow')
            $value='<font color='.$value.'>'.$value.'</font>';
          $out_text.=$key;
          $out_text.='=>';
          $out_text.=$value;
          $out_text.=' | ';
        }
        $out_text.=' | <br />';
      }
//      $out_text.='<br />';
    }
    $out_text.='turn=>'.$this->turn.' end <br /><br />';
    $fp=fopen('game_stat.html', 'a');
    fwrite($fp, $out_text);
    fclose($fp);
  }

  public function clearStatFile() {
    $fp=fopen('game_stat.html', 'wb');
    fwrite($fp, '<html><head></head><body>');
    fclose($fp);
  }
}





/*    echo <<<_END
    Move pawn No
    <input type="radio" name="pawn_num" value="1" $checked[0]> 1 |
    <input type="radio" name="pawn_num" value="2" $checked[1]> 2 |
_END; /**/