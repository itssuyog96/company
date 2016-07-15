$( document ).ready(function() {
//flag=0;
// Write your custom Javascript codes here...

$('.fixed-sidebar-check').click();
$('.horizontal-bar-check').click();
$('.boxed-layout-check').click();
$('.compact-menu-check').click();


$('.date-picker').datepicker({
   orientation: "top auto",
   autoclose: true
});

var crClockInit1 = null;
var crClockInterval = null;
function crInitClock() {
    crClockInit1 = setInterval(function() {
        if (moment().format("SSS") <= 40) {
            clearInterval(crClockInit1);
            crStartClockNow();
        }
    }, 30);
}

function crStartClockNow() {
    crClockInterval = setInterval(function() {
      //if(flag==0){
        $('#clock').html(moment().format('DD - MMMM - YYYY H:mm:ss'));
        //flag=1;
      //}
        //else{
          //$('#clock').html(moment().format('D, MMMM, YYYY H mm ss'));
          //flag=0;
        //}
    }, 1000);

}

crInitClock();

    $('#table_id').DataTable();

});
