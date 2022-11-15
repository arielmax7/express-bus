<?php
//** control de asientos MD-3
$no_permited="5 6 7 9 10 11 13 14 15 17 18 19 21 22 23 25 26 27 29 30 31 33 34 35 37 38 39 41 42 43 45 46 47 49 51 53 54 55 57 58 59 61 62 63 65 66 67 69 70";
if(preg_match('/'.$num_places_bus.'/',$no_permited) || $num_places_bus < 4 || $num_places_bus > 70){
	if($option_bar=="new"){
    no_support_lib_gen_new();
	}
	no_support_lib_gen_edit();
}
?>