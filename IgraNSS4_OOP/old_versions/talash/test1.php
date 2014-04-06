<?php
include_once 'Road.class.php';
include_once 'Playground.class.php';
$pg=new Playground();
$pg->roadPositions();
  $show_array=$pg->setPlayground();
  echo '<table border="1" background="pics/back1.jpg">';
  for($i=0; $i<15; $i++) {
    echo '<tr>';
    for($j=0; $j<15; $j++) {
        //echo 'pasta';
      echo $show_array[$i][$j];
    }
    echo '</tr>';
  }
  echo '</table>';



/**/


  /*
    echo '<table border="1" background="pics/back1.jpg">';
  foreach($show_array as $row) {
    echo '<tr>';
    foreach($row as $element) {
        echo 'pasta';
      //echo $show_array[$row][$element];
    }
    echo '</tr>';
  }
  echo '</table>';
  /**/
  
  // $pg->fillPlaygroundRoad();
// $r=new Road();


/*
echo 'Special and decoration positions: <br />';
for ($i=0;$i<45;$i++) {
  $result = $pg->getNext();
  for ($j=0;$j<4;$j++) {
    echo $result[$j].', ';
  }
  echo ' *** ';
}

echo '<br /><br />Road positions: <br />';
for ($i=0;$i<56;$i++) {
  $result = $pg->road->getNextRoad();
  for ($j=0;$j<4;$j++) {
    echo $result[$j].', ';
  }
  echo ' *** ';
} /**/

//    echo '<br />$pg<br />';
//    var_dump($pg);




//  $el0=$pg->getElement(0);
//  $el1=$pg->getElement(1);
//  var_dump($el0);
//  var_dump($el1);
?>