<?php
//** control de asientos MD-5
$no_permited="38 39 41 42 43 45 46 47 49 51 53 54 55 57 58 59";
if(preg_match('/'.$num_places_bus.'/',$no_permited) || $num_places_bus < 37 || $num_places_bus > 60){
	if($option_bar=="new"){
    no_support_lib_gen_new();
	}
	no_support_lib_gen_edit();
}
?>