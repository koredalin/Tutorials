<?php
class HtmlInput{
  public function __construct(){

  }
  
  public function htmlHeader() {
    echo '<br /><br /><hr /><h2>Не се сърди човече!</h2>';
    echo '<hr /><br />';
  }

  public function showPlayersform() {
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
    echo '<option value="yellow">жълто</option>';
    echo '<option value="green">зелено</option>';
    echo '<option value="blue">синьо</option>';
    echo '<option value="red">червено</option>';
    echo '</select>';
    echo '</td></tr>';
    echo '<tr><td colspan="2" align="center">';
    echo '<input type="submit">';
    echo '</td></tr>';
    echo '</table>';
    echo '</form><hr />';
    echo 'Забележка: Компютърът подрежда останалите цветове по реда им на листа.';
  }

  public function setPlayersInfo($players_num, $first_color) {

  }

  public function htmlFooter() {
    echo '</body></html>';
  }
}