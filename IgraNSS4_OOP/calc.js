$(document).ready(function(){
  $('#test_hide').click(hideOldData);
 /* $('#ajax_data').click(showOldData);
  $('#show_pawns').click(showPawns); /**/
  $('#play').click(loadData);
});

function hideOldData(){
  $('td div').hide();
  // $('#pl_name, #dice, #radio, #turn_num, .ex').hide();
}

function showOldData(){
  $('.ex').show();
  $('td div, td p, td font').show();
}

function loadData() {
  var r=1;
  if (($("#r1:checked").length > 0)) {
    r=1;
    $('#r1').prop('checked', false);
  }
  else if (($("#r2:checked").length > 0)) {
    r=2;
    $('#r2').prop('checked', false);
  }
  else if (($("#r3:checked").length > 0)) {
    r=3;
    $('#r3').prop('checked', false);
  }
  else {
    r=4;
    $('#r4').prop('checked', false);
  }
  $.ajax({
    url:'game_play.php',
    type: "POST",
    data:{
      radio:r
    },
    dataType:'json'
  }).done(function(data){
      pawns_data=data[0];
      turn_data=data[1];    
    showPawns(pawns_data, turn_data);
  });
  request.fail(function(){
    console.log('error');
  }); /**/
}

function showPawns(data) { 
  console.log('pawns_data.length: '+pawns_data.length);
  console.log('turn_data.length: '+turn_data.length);
  hideOldData();
  for (var i=0; i<pawns_data.length; i++){
    for (var j=0; j<3; j++){
      //console.log(pawns_data[i][j]);
      if (pawns_data[i][1]=='4p') {
        $('#'+pawns_data[i][0]).html(
          "<div class='d_41'>"+
	    "<img src='pics/"+pawns_data[i][2]+"_pawn.png'><img src='pics/"+pawns_data[i][2]+"_pawn.png'><br />"+
		"<img src='pics/"+pawns_data[i][2]+"_pawn.png'><img src='pics/"+pawns_data[i][2]+"_pawn.png'>"+
	    "<div class='d_42'>"+
		  "<span class='s_41'>12</span>"+
		  "<span class='s_42'>34</span>"+
	    "</div></div>"
         );
      }
      else if (pawns_data[i][1].length==1) {
        $('#'+pawns_data[i][0]).html(
          "<div class='d_11'>"+
	    "<img class='i1' src='pics/"+pawns_data[i][2]+"_pawn.png'>"+
	    "<div class='d_12'>"+
              "<span class='s_1'>"+pawns_data[i][1]+"</span>"+
	    "</div></div>" /**/
        );
        // $('#pawns_data[i][0]').show();
      }
      else if (pawns_data[i][1].length==2) {
        $('#'+pawns_data[i][0]).html(
          "<div class='d_21'>"+
	    "<img src='pics/"+pawns_data[i][2]+"_pawn.png'><img src='pics/"+pawns_data[i][2]+"_pawn.png'>"+
	    "<div class='d_22'>"+
		  "<span class='s_2'>"+pawns_data[i][1]+"</span>"+
	    "</div></div>"
        );
      }
      else if (pawns_data[i][1].length==3) {
        $('#'+pawns_data[i][0]).html(
 	  "<div class='d_31'>"+
	    "<img src='pics/"+pawns_data[i][2]+"_pawn.png'><br />"+
	    "<img src='pics/"+pawns_data[i][2]+"_pawn.png'><img src='pics/"+pawns_data[i][2]+"_pawn.png'>"+
	    "<div class='d_32'>"+
		  "<span class='s_3'>"+pawns_data[i][1]+"</span>"+
	    "</div></div>"
        );
      }
    }
  }
  // console.log('turn_data.length= '+turn_data.length);
  $('#pl_name').html(
     "<span style='color:"+turn_data[0][1]+"; font-size:16pt; font-weight:bold'>"+turn_data[0][0]+"</span>"
  );
  $('#pl_name').show();
  $('#dice').html(
    "<img class='normal' src='pics/zar"+turn_data[1]+".jpg' alt='"+turn_data[1]+"'>"
  );
  $('#dice').show();

  var r_check='#r';
  r_check+=turn_data[2][1];
//  console.log('r_check: '+r_check);
  $(r_check).prop('checked', true);
  $('#turn_num').html(
    "<span id='turn_num'><font color='"+turn_data[0][1]+"'>"+turn_data[3]+"</font></span>"
  );
  $('#turn_num').show();
  $('.ex').html(
    stripslashes(turn_data[4])
  );
  $('.ex').show();
}

function addslashes(str) {
  str=str.replace(/\\/g,'\\\\');
  str=str.replace(/\'/g,'\\\'');
  str=str.replace(/\"/g,'\\"');
  str=str.replace(/\0/g,'\\0');
  return str;
}

function stripslashes(str) {
  str=str.replace(/\\'/g,'\'');
  str=str.replace(/\\"/g,'"');
  str=str.replace(/\\0/g,'\0');
  str=str.replace(/\\\\/g,'\\');
  return str;
}

//  data=jQuery.parseJSON(data);
//  console.log(data);
  /*var data = eval($('#turn_data'));
  console.log("length=" + data.length);
//  var data = document.getElementById('turn_data');
//  data=data.innerHTML;
  var first_element = data[0];
  console.log("length=" + first_element.length);
 *var data = document.getElementById('turn_data');
var inner_data = data.innerHTML;
console.log(inner_data);
console.log("len=" + inner_data.length);
var json_array = JSON.parse(inner_data);
console.log("len=" + json_array.length);
  //$('#turn_data').eval(string)
/*  i=0;
  for (i=0; i<5; i++){
    console.log(turn_data[i]);
  } /**/
/* function showAjaxData() {
  /*$("#respond").load("game_play.php", function(response, status, xhr) {
      $(this).html(response);
  if (status == "error") {
    var msg = "Sorry but there was an error: ";
    $("#respond").html(msg + xhr.status + " " + xhr.statusText);
    console.log('error');
  }
  console.log('ok');
});
  var request=$.ajax({
    type: "GET",
    url:'game_play.php',
    dataType:'json'
  });
  request.done(function(data){
    showPawns(data);
    console.log('alright');
  });
  request.fail(function(er){
    console.log('error');
  });
}/**/
/*
    // console.log('data.length: '+data.length);
    // console.log("ok");
//jQuery.globalEval("var answer = data;");
    //var aj_answer=eval(data);
var rad=['', '', '', '']
  rad[turn_data[2]]='checked';
$('#radio').html(
    "<input type='radio' name='pawn_num' value='1' "+rad[0]+"> 1 |"+
    "<input type='radio' name='pawn_num' value='2' "+rad[1]+"> 2 |"+
    "<input type='radio' name='pawn_num' value='3' "+rad[2]+"> 3 |"+
    "<input type='radio' name='pawn_num' value='4' "+rad[3]+"> 4 "
  ); /**/
  // $('#radio').show();