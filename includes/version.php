<?php
//** INFORMACION DE VERSION DE EXPRESS BUS *//
//** POR RAZONES DE COPYRIGHT ESTE ARCHIVO NO SERA COMENTARIADO AL DETALLE NI LOS ARCHIOVS DE INSTALACION *//
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class express_bus_Version {
	
	var $PRODUCT 	= 'Express Bus Tickets';
	
	var $RELEASE 	= '2.2';
	
	var $DEV_STATUS = 'Beta';
	
	var $DEV_LEVEL 	= '60';
	
	var $BUILD	 	= '$Revision: 1045 $';
	
	var $CODENAME 	= 'TXBUS';
	
	var $RELDATE 	= '16 octubre 2019';
	
	var $RELTIME 	= '14:00';
	
	var $RELTZ 		= 'UTC';
	
	var $COPYRIGHT 	= "Copyright (C) 2019 Open Source. All rights reserved.";
	
	var $URL 		= '<a href="https://www.arielmax.com">Express Bus</a> is Free Software released under the GNU/GPL License.';
	
	var $SITE 		= 1;
	
	var $RESTRICT	= 0;
	
	var $SVN		= 0;

	
	
	function getLongVersion() {
		return $this->PRODUCT .' '. $this->RELEASE .'.'. $this->DEV_LEVEL .' '
			. $this->DEV_STATUS
			.' [ '.$this->CODENAME .' ] '. $this->RELDATE .' '
			. $this->RELTIME .' '. $this->RELTZ;
	}

	
	function getShortVersion() {
		return $this->RELEASE .'.'. $this->DEV_LEVEL;
	}

	
	function getHelpVersion() {
		if ($this->RELEASE > '1.0') {
			return '.' . str_replace( '.', '', $this->RELEASE );
		} else {
			return '';
		}
	}
}
$_VERSION = new express_bus_Version();

$version = $_VERSION->PRODUCT .' '. $_VERSION->RELEASE .'.'. $_VERSION->DEV_LEVEL .' '
. $_VERSION->DEV_STATUS
.' [ '.$_VERSION->CODENAME .' ] '. $_VERSION->RELDATE .' '
. $_VERSION->RELTIME .' '. $_VERSION->RELTZ;
?>