<?php
function sanitize_output($string) {
    if ($string === null) return '';
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function sanitize_attribute($string) {
    if ($string === null) return '';
    return htmlspecialchars($string, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

function validate_callsign($callsign) {
    $callsign = trim($callsign);
    if (preg_match('/^[A-Z0-9\-\/\s]{3,20}$/i', $callsign)) {
        return strtoupper($callsign);
    }
    return '';
}

function validate_module($module) {
    $module = trim(strtoupper($module));
    if (preg_match('/^[A-Z]$/', $module)) {
        return $module;
    }
    return '';
}

function validate_protocol($protocol) {
//    $allowed = ['DPlus', 'DExtra', 'DCS', 'DMR', 'DMRplus', 'DMRMmdvm', 'YSF', 'XLX', 'Terminal/AP', 'IMRS', 'none', 'USRP'];
    $allowed_protocols = ['DPlus', 'DExtra', 'DCS', 'DMR', 'DMRplus', 'DMRMmdvm', 'YSF', 'XLX', 'Terminal/AP', 'IMRS', 'none', 'USRP', 'NXDN', 'P25'];
    return in_array(trim($protocol), $allowed, true) ? trim($protocol) : '';
}

function GetSystemUptime() {
    if (file_exists('/proc/uptime')) {
        $uptime = @file_get_contents('/proc/uptime');
        if ($uptime !== false) {
            $parts = explode(' ', $uptime);
            return isset($parts[0]) ? (int)$parts[0] : 0;
        }
    }
    return 0;
}

function Debug($message) {
    if (defined('DEBUG_MODE') && DEBUG_MODE === true) {
        echo '<br><hr><pre>';
        print_r($message); // Don't sanitize here as it's debug only
        echo '</pre><hr><br>';
    }
}

function ParseTime($Input) {
   
    if (strpos($Input, "<") !== false) {
       $Input = substr($Input, 0, strpos($Input, "<"));
    }
    
    if (strpos($Input, "T") !== false) {
        return strtotime($Input);
    }

    // Tuesday Tue Nov 17 14:23:22 2015
    $tmp  = explode(" ", $Input);
    if (strlen(trim($tmp[3])) == 0) {
       unset($tmp[3]);
       $tmp = array_values($tmp);
    }

    $tmp1 = explode(":", $tmp[4]); 
    $month = "";
    switch (strtolower($tmp[2])) {
      case 'jan' : $month = 1; break;
      case 'feb' : $month = 2; break;
      case 'mar' : $month = 3; break;
      case 'apr' : $month = 4; break;
      case 'may' : $month = 5; break;
      case 'jun' : $month = 6; break;
      case 'jul' : $month = 7; break;
      case 'aug' : $month = 8; break;
      case 'sep' : $month = 9; break;
      case 'oct' : $month = 10; break;
      case 'nov' : $month = 11; break;
      case 'dec' : $month = 12; break;
      default    : $month = 1; 
    }
    return @mktime($tmp1[0], $tmp1[1], $tmp1[2], $month, $tmp[3], $tmp[5]);
    
}

function FormatSeconds($seconds) {
  $seconds = abs($seconds); 
  return sprintf("%d days %02d:%02d:%02d", $seconds/60/60/24,($seconds/60/60)%24,($seconds/60)%60,$seconds%60);
} 

function CreateCode ($laenge) {   
	$zeichen = "1234567890abcdefghijklmnopqrstuvwyxzABCDEFGHIJKLMNAOPQRSTUVWYXZ";   
	mt_srand( (double) microtime() * 1000000); 
	$out = "";
	for ($i=1;$i<=$laenge;$i++){ 
		$out .= $zeichen[mt_rand(0,(strlen($zeichen)-1))];       
	}         
	return $out;  
}

?>
