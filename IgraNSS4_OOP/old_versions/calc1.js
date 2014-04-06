$(document).ready(function(){
  $('#play').click(loadData);
  $('#test').click(loadData);
});


function loadData() {
  var r=0;
  console.log(r);
  if (($("#r0:checked").length > 0)) {
    r=0;
    $('#r0').prop('checked', false);
  }
  else if (($("#r1:checked").length > 0)) {
    r=1;
    $('#r1').prop('checked', false);
  }
  else if (($("#r2:checked").length > 0)) {
    r=2;
    $('#r2').prop('checked', false);
  }
  else {
    r=3;
    $('#r3').prop('checked', false);
  }
  console.log(r);
}