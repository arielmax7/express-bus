<?php
//** control de asientos MD-1
$no_permited="7 8 9 10 11 12 13 14 16 17 18 20 21 22 24 25 26 28 29 30 32 33 34 36 37 38 40 41 42 44 45 46 48 49 50 52 53 54 56 57 58 60 61 62 64 65 66";
if(preg_match('/'.$num_places_bus.'/',$no_permited) || $num_places_bus < 6 || $num_places_bus > 67){
	if($option_bar=="new"){
    no_support_lib_gen_new();
	}
	no_support_lib_gen_edit();
}
?>