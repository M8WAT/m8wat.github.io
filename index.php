<?php
// Check if we are serving HTTPS
function isHttps() {
    // Check standard HTTPS indicators
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        return true;
    }
    if (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443) {
        return true;
    }
    // Check for proxy/load balancer headers
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
        return true;
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] === 'on') {
        return true;
    }
    return false;
}

// Secure session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_samesite', 'Strict');
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    ini_set('session.cookie_secure', 1);
}

session_start();

// Security headers
$isHttps = isHttps();
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

// Build CSP based on protocol
// Allow external images via both http: and https: since we can't control external links
$imgSrc = $isHttps ? "'self' data: https:" : "'self' data: http: https:";

//$csp = "default-src 'self'; " .
//        "script-src 'self' 'unsafe-inline'; " .
//        "style-src 'self' 'unsafe-inline'; " .
//        "img-src {$imgSrc}; " .
//        "connect-src 'self'; " .
//        "frame-ancestors 'self' 'https://dvs.buxton.radio'";
//
//header("Content-Security-Policy: " . $csp);

// Only add HSTS if served over HTTPS
if ($isHttps) {
        // HSTS: Force HTTPS for 1 year, but don't include subdomains (might be on local network)
        header("Strict-Transport-Security: max-age=31536000");
}

if (file_exists("./css/theme.php"))       { require_once("./css/theme.php"); } else { die("theme.php does not exist."); }
if (file_exists("./pgs/functions.php"))   { require_once("./pgs/functions.php"); } else { die("functions.php does not exist."); }
if (file_exists("./pgs/config.inc.php"))  { require_once("./pgs/config.inc.php"); } else { die("config.inc.php does not exist."); }

if (!class_exists('ParseXML'))   require_once("./pgs/class.parsexml.php");
if (!class_exists('Node'))       require_once("./pgs/class.node.php");
if (!class_exists('xReflector')) require_once("./pgs/class.reflector.php");
if (!class_exists('Station'))    require_once("./pgs/class.station.php");
if (!class_exists('Peer'))       require_once("./pgs/class.peer.php");
if (!class_exists('Interlink'))  require_once("./pgs/class.interlink.php");

// Validate 'show' parameter
$allowed_pages = ['users', 'repeaters', 'peers', 'modules', 'reflectors', 'allmon', 'tgif'];
if (!isset($_GET['show'])) {
    $_GET['show'] = '';
} elseif (!in_array($_GET['show'], $allowed_pages, true)) {
    $_GET['show'] = '';
}

// Validate 'callhome' parameter
if (isset($_GET['callhome'])) {
    $_GET['callhome'] = filter_var($_GET['callhome'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    if ($_GET['callhome'] === null) {
        unset($_GET['callhome']);
    }
}

$Reflector = new xReflector();
$Reflector->SetFlagFile("./pgs/country.csv");
$Reflector->SetPIDFile($Service['PIDFile']);
$Reflector->SetXMLFile($Service['XMLFile']);

$Reflector->LoadXML();

if ($CallingHome['Active']) {

   $CallHomeNow = false;
   $LastSync = 0;
   $Hash = "";

   if (!file_exists($CallingHome['HashFile'])) {
      $Ressource = fopen($CallingHome['HashFile'], "w+");
      if ($Ressource) {
         $Hash = CreateCode(16);
		   @fwrite($Ressource, "<?php\n");
		   @fwrite($Ressource, "\n".'$Hash = "'.$Hash.'";');
		   @fwrite($Ressource, "\n\n".'?>');
		   @fflush($Ressource);
		   @fclose($Ressource);
		   @chmod($HashFile, 0777);
		}
   }
   else {
      require_once($CallingHome['HashFile']);
   }

   if (@file_exists($CallingHome['LastCallHomefile'])) {
      if (@is_readable($CallingHome['LastCallHomefile'])) {
         $tmp      = @file($CallingHome['LastCallHomefile']);
         if (isset($tmp[0])) {
            $LastSync = $tmp[0];
         }
         unset($tmp);
      }
   }

   if ($LastSync < (time() - $CallingHome['PushDelay'])) {
      $CallHomeNow = true;
      $Ressource = @fopen($CallingHome['LastCallHomefile'], "w+");
	   if ($Ressource) {
	      @fwrite($Ressource, time());
		   @fflush($Ressource);
		   @fclose($Ressource);
		   @chmod($HashFile, 0777);
		}
   }

   if ($CallHomeNow || isset($_GET['callhome'])) {
      $Reflector->SetCallingHome($CallingHome, $Hash);
      $Reflector->ReadInterlinkFile();
      $Reflector->PrepareInterlinkXML();
      $Reflector->PrepareReflectorXML();
      $Reflector->CallHome();
   }

}
else {
   $Hash = "";
}

?>

<!-- -------------------------------- HTML --------------------------------- -->

<!DOCTYPE html>

<!-- -------------------------------- HEAD --------------------------------- -->

<head>

   <meta charset="UTF-8">

   <meta name="viewport"    content="width=device-width, initial-scale=1.0">

   <meta name="description" content="<?php echo sanitize_attribute($PageOptions['MetaDescription']); ?>" />
   <meta name="keywords"    content="<?php echo sanitize_attribute($PageOptions['MetaKeywords']); ?>" />
   <meta name="author"      content="<?php echo sanitize_attribute($PageOptions['MetaAuthor']); ?>" />
   <meta name="revisit"     content="<?php echo sanitize_attribute($PageOptions['MetaRevisit']); ?>" />
   <meta name="robots"      content="<?php echo sanitize_attribute($PageOptions['MetaRobots']); ?>" />

   <link rel="stylesheet" type="text/css" href="./css/layout.php">

   <link rel="icon" href="./img/favicon.svg" type="image/svg+xml" sizes="any">

   <title>
      URF178
      <?php
//         echo sanitize_output($Reflector->GetReflectorName());
      ?>
	   Reflector Dashboard
   </title>

   <?php

      if ($PageOptions['PageRefreshActive']) {
         echo '
            <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
            <script>
               var PageRefresh;
               function ReloadPage() {
                  $.get("./index.php'.(isset($_GET['show'])?'?show='.$_GET['show']:'').'", function(data) {
                     var MainStart = data.indexOf("<ma"+"in>");
                     var MainEnd = data.indexOf("</ma"+"in>");
                     if ((MainStart >= 0) && (MainEnd > MainStart)) {
                        MainStart = data.indexOf(">", MainStart)+1;
                        $("main").html(data.substring(MainStart, MainEnd));
                     }
                  })
                  .always(function() {
                     PageRefresh = setTimeout(ReloadPage, '.$PageOptions['PageRefreshDelay'].');
                  });
               }';
               if (!isset($_GET['show']) || (($_GET['show'] != 'reflectors') && ($_GET['show'] != 'interlinks') && ($_GET['show'] != 'allmon') && ($_GET['show'] != 'tgif'))) {
                  echo '
                     PageRefresh = setTimeout(ReloadPage, '.$PageOptions['PageRefreshDelay'].');';
               }
               echo '
                  function SuspendPageRefresh() {
                     clearTimeout(PageRefresh);
                  }
            </script>';
      }

      if (!isset($_GET['show'])) $_GET['show'] = "";

   ?>

</head>

<!-- -------------------------------- BODY --------------------------------- -->

<body>

   <div class="primary-container">

<!-- ------------------------------- Header -------------------------------- -->

   <header class="header">

      <img src="/img/header.svg">

      <p>
         We welcome <mark>ALL</mark> to use the reflector. It only utilises Module A with full hardware transcoding. It supports:
         <a href="https://stats.allstarlink.org/stats/621821" target="_blank">AllStar</a> (621821),
         <mark>DMR</mark>,
         <mark>DStar</mark>,
         <a href="https://echolink.org" target="_blank">Echolink</a> (G4BUX-L),
         <mark>G3</mark>,
         <a href="https://www.qrz.com/db/GB3HH" target="_blank">GB3HH</a>,
         <mark>NXDN</mark> (178),
         <mark>M17</mark>,
         <mark>P25</mark> (178),
         <a href="https://peanut.pa7lim.nl" target="_blank">Peanut</a> (XLX178A),
         <a href="https://tgif.network/tgprofile.php?id=178" target="_blank">TGIF</a> (TG178)</a>,
         and
         <mark>YSF</mark> (00178).
         <hide>
         Please note the AllStar, Echolink, GB3HH and TGIF connections show as
         <a href="https://www.qrz.com/db/G4BUX">G4BUX</a>.
         </hide>
      </p>

<!-- --------------------------- Navigation Bar ---------------------------- -->

      <div class="navbar">

         <button class="paused" id="play-btn">Live Stream</button>
         <a href="./index.php" class="navbarlink<?php if ($_GET['show'] == '') { echo 'active'; } ?>">Users</a>
         <a href="./index.php?show=repeaters" class="navbarlink<?php if ($_GET['show'] == 'repeaters') { echo 'active'; } ?>">Nodes (<?php echo $Reflector->NodeCount(); ?>)</a>
         <a href="./index.php?show=modules" class="navbarlink<?php if ($_GET['show'] == 'modules') { echo 'active'; } ?>">Modules</a>
         <a href="./index.php?show=reflectors" class="navbarlink<?php if ($_GET['show'] == 'reflectors') { echo 'active'; } ?>">Reflectors<hide> List</hide></a>
         <a href="./index.php?show=allmon" class="navbarlink<?php if ($_GET['show'] == 'allmon') { echo 'active'; } ?>">Allmon3<hide> Dash</hide></a>
         <a href="./index.php?show=tgif" class="navbarlink<?php if ($_GET['show'] == 'tgif') { echo 'active'; } ?>">TGIF <hide>TG178 </hide>DVS<hide>witch</hide></a>
      </div>

   </header>

<!-- ---------------------------- Page Content ----------------------------- -->

   <main>

      <div class="content" align="center">

         <div class="flex-container">

               <?php

                  if ($CallingHome['Active']) {
                     if (!is_readable($CallingHome['HashFile']) && (!is_writeable($CallingHome['HashFile']))) {
                        echo '
                           <div class="error">
                              Your private hash in '.sanitize_output($CallingHome['HashFile']).' could not be created. Please check your config file and the permissions for the defined folder.
                           </div>';
                     }
                  }

                  switch ($_GET['show']) {
                     case 'users'      : require_once("./pgs/users.php"); break;
                     case 'repeaters'  : require_once("./pgs/repeaters.php"); break;
                     case 'peers'      : require_once("./pgs/peers.php"); break;
                     case 'modules'    : require_once("./pgs/modules.php"); break;
                     case 'reflectors' : require_once("./pgs/reflectors.php"); break;
                     case 'allmon'     : require_once("./pgs/allmon.php"); break;
                     case 'tgif'       : require_once("./pgs/tgif.php"); break;
                     default           : require_once("./pgs/users.php");
                  }

               ?>

         </div>

      </div>

   </main>

<!-- ------------------------------- Footer -------------------------------- -->

   <footer class="footer">
      <mark>URF178</mark>
         <?php
//            echo sanitize_attribute($Reflector->GetReflectorName());
         ?>
      is maintained by Ash -
      <a href="https://www.qrz.com/db/M8WAT">M8WAT</a>
      & Jon -
      <a href="https://www.qrz.com/db/EA5JMN">EA5JMN</a> / <a href="https://www.qrz.com/db/G7NFK">G7NFK</a>
   </footer>

   </div>

<!-- ------------------------- Live Stream Script -------------------------- -->

   <audio id="radio-stream" src="https://stream.buxton.radio/stream" type="audio/mpeg"></audio>

   <script>

      // Set the Button and the Audio elements
      const btn   = document.getElementById('play-btn');
      const player = document.getElementById('radio-stream');

      // Set the button’s text and its CSS class
      function updateButton(state) {
         if (state === 'playing') {
            btn.textContent = 'Live Stream';
            btn.classList.remove('paused');
            btn.classList.add('playing');
         } else {                 // paused
            btn.textContent = 'Live Stream';
            btn.classList.remove('playing');
            btn.classList.add('paused');
         }
      }
      
      // Listen for the click and flip the state
      btn.addEventListener('click', () => {
         if (player.paused) {
            player.play();          // start playback
            updateButton('playing'); 
         } else {
            player.pause();         // stop playback
            updateButton('paused');
         }
      });
   
   </script>

</body>

</html>

