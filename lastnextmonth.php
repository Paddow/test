<style>
.kalenderdag{
    width: 5rem;
    background-color:aquamarine;
}

.kalenderdagToday{
    width: 5rem;
    background-color:black;
}

</style>
<h1>Kalender</h1>
<?php

//CURRENT MONTH//

 // functie date() levert string met gewenste datum-informatie (zie https://www.w3schools.com/php/php_date.asp voor volledige mogelijkheden date)
 // door er (int) voor te zetten zet php deze strings om naar integers
 $dag = (int)date('d'); 
 $maand = (int)date('m'); 
 $jaar = (int)date('Y');
 $prevmonth = $maand -1;
;

// eerste dag van deze maand als datum-type 
 $eerste_dag = mktime(0,0,0, $maand, 1, $jaar) ; 

 // naam van deze maand als string 
$maand_str = date('F', $eerste_dag);
 
 // op welke dag valt de 1e dag van deze maand 
 $weekdag = date('D', $eerste_dag) ; 

 // bekijk hoeveel weekdagen er voor de 1e dag van de maand liggen
 $weekdagen_vorige_maand = 0;
 switch($weekdag){ 
     case "Sun": $weekdagen_vorige_maand = 0; break; 
     case "Mon": $weekdagen_vorige_maand = 1; break; 
     case "Tue": $weekdagen_vorige_maand = 2; break; 
     case "Wed": $weekdagen_vorige_maand = 3; break; 
     case "Thu": $weekdagen_vorige_maand = 4; break; 
     case "Fri": $weekdagen_vorige_maand = 5; break; 
     case "Sat": $weekdagen_vorige_maand = 6; break; 
 }

 // hoeveel dagen zitten er in deze maand
 $aantal_dagen = cal_days_in_month(0, $maand, $jaar) ; 
 

// welke dag van de week is het, zondag=1 zaterdag=7
 $weekdag_teller = 1;
?>
<table>
   <tr><th colspan="7"><?php print "$maand_str $jaar";?></th></tr>
   <tr><td>S</td><td>M</td><td>T</td><td>W</td><td>T</td><td>F</td><td>S</td></tr>
   <tr>
<?php   

//print het aantal $weekdagen_vorige_maand lege cellen
while(0<$weekdagen_vorige_maand){ 
    print "      <td></td>\n"; // \n zorgt voor nieuwe regel in broncode html
    $weekdagen_vorige_maand--; // $weekdagen_vorige_maand = $weekdagen_vorige_maand - 1;
    $weekdag_teller++;         // $weekdag_teller = $weekdag_teller + 1;
}
  
// hoeveelste dag van de maand is het 
$dag_teller = 1;

while ( $dag_teller <= $aantal_dagen ){ 
    if ($dag == $dag_teller){
        echo "      <td><div class=\"kalenderdagToday\">$dag_teller</div></td>\n"; 
    }
    else
     echo "      <td><div class=\"kalenderdag\">$dag_teller</div></td>\n"; 
     $dag_teller++; 
     $weekdag_teller++;
         
     // elke week een nieuwe rij beginnen
     if (7 < $weekdag_teller){
         print "   </tr><tr>\n";
         $weekdag_teller = 1;
     }
 }

  // voor elke weekdag in nieuwe maand lege cel printen
 while ( $weekdag_teller >1 && $weekdag_teller <=7 )
 {
     print "<td> </td>";
     $weekdag_teller++;
 }

print "</tr></table>";
 
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div><button id="Prev">Prev</button><div id="displayDate"></div><button id="Next">Next</button></div>

<script>
var today = new Date();
 date = today.getDate();
 month= today.getMonth();
year= today.getFullYear();
month = month+1;

$("#Prev").click(function(){
   date = date -1;
  if(date<1){
  month = month -1;
    if(month == 0){
      year = year -1;
      date = 31;
      month = 12;
      } else{
      if(month == 2){
      date = 28
      } else if(month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12){
       date = 31
      } else{
       date = 30
      }
      }
  }
  $("#displayDate")[0].innerHTML = date + "/" +  month + "/" + year;
});

$("#Next").click(function(){
   date = date + 1;
  if(date>28 && month == 2){
    date = 1;
    month = 3;
 } 
  if( date> 30 && (month == 4 || month == 6 || month == 9 || month == 11)){
  date = date +1;
    month = month +1;
  } else  if (date> 31){
  date =1; 
    month = month+1;
    if(month >12){
    year = year +1;
      month= 1; 
      date = 1;
    }
  }  
  
  $("#displayDate")[0].innerHTML = date + "/" +  month + "/" + year;
});

$("#displayDate")[0].innerHTML = date + "/" +  month + "/" + year;


</script>