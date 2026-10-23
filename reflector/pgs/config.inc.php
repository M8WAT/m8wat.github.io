<?php

$CallingHome = array();
$PageOptions = array();
$Service     = array();

$CallingHome['Active']                      = true;				// xlx phone home, true or false
$CallingHome['MyDashBoardURL']              = 'https://xlx.buxton.radio';	// dashboard url
$CallingHome['ServerURL']                   = 'http://xlxapi.rlx.lu/api.php';	// database server, do not change !!!!
$CallingHome['PushDelay']                   = 600;				// push delay in seconds
$CallingHome['Country']                     = "Buxton, GB";		// Country
$CallingHome['Comment']                     = "URF178 - Buxton Radio Amateurs - Linked to GB3HH, AllStar 621821, Echolink G4BUX-L, Peanut XLX178A and TGIF 178. Supports DMR, DStar, G3, NXDN, P25 and YSF.";	// Comment. Max 100 character
$CallingHome['HashFile']                    = "/etc/urfd/callinghome.php";		// Make sure the apache user has read and write permissions in this folder.
$CallingHome['LastCallHomefile']            = "/etc/urfd/lastcallhome.php";		// lastcallhome.php can remain in the tmp folder
$CallingHome['OverrideIPAddress']           = "80.229.161.124";				// Insert your IP address here. Leave blank for autodetection. No need to enter a fake address.
$CallingHome['InterlinkFile']               = "/etc/urfd/urfd.interlink";		// Path to interlink file

$PageOptions['PageRefreshActive']           = true;				// Activate automatic refresh
$PageOptions['PageRefreshDelay']            = '10000';				// Page refresh time in miliseconds

$PageOptions['RepeatersPage'] = array();
$PageOptions['RepeatersPage']['LimitTo']    = 100;				// Number of Repeaters to show

$PageOptions['PeerPage'] = array();
$PageOptions['PeerPage']['LimitTo']         = 100;				// Number of peers to show

$PageOptions['LastHeardPage']['LimitTo']    = 100;				// Number of stations to show

// Number of Modules enabled on the reflector and their nominations
$PageOptions['NumberOfModules']             = 1;
$PageOptions['ModuleNames'] = array();
$PageOptions['ModuleNames']['A']            = 'All Modes';

// Meta Tag Values, useful for Search Engine
$PageOptions['MetaDescription']             = 'XLX178 - Buxton Radio Amateurs XLX Multi-Protocol Digital Reflector for Ham Radio Operators.';
$PageOptions['MetaKeywords']                = 'Buxton Radio Amateurs, Ham Radio, D-Star, XReflector, XLX, XRF, DCS, REF, XLX178, YSF, DMR, Peanut, DMR+, DStar, Reflector, XLXd, Ambed, Ambeserver,';
$PageOptions['MetaAuthor']                  = 'M8WAT';
$PageOptions['MetaRevisit']                 = 'After 30 Days';
$PageOptions['MetaRobots']                  = 'index,follow';

$Service['PIDFile']                         = '/var/log/xlxd.pid';
$Service['XMLFile']                         = '/var/log/xlxd.xml';

?>