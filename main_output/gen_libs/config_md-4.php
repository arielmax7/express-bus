<?php
//** control de asientos MD-4
$no_permited="55 57";
if(preg_match('/'.$num_places_bus.'/',$no_permited) || $num_places_bus < 55 || $num_places_bus > 57){
	if($option_bar=="new"){
    no_support_lib_gen_new();
	}
	no_support_lib_gen_edit();
}
?>