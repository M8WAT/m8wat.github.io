<?php
  
  $Result = @fopen($CallingHome['ServerURL']."?do=GetReflectorList", "r");
  
  if (!$Result) die("HEUTE GIBTS KEIN BROT");
  
  $INPUT = "";
  while (!feof ($Result)) {
    $INPUT .= fgets ($Result, 1024);
    }
  
  fclose($Result);
  
  $XML = new ParseXML();
  $Reflectorlist = $XML->GetElement($INPUT, "reflectorlist");
  $Reflectors    = $XML->GetAllElements($Reflectorlist, "reflector");

  ?>

<table class="listingtable">
  <tr>
    <th>&nbsp;&nbsp;#&nbsp;&nbsp;</th>
    <th>Reflector</th>
    <th>Location</th>
    <th>Up</th>
    <th>Comment</th>
  </tr>

  <?php

    $rowcolor = "";

    for ($i=0;$i<count($Reflectors);$i++) {
      
      $NAME          = sanitize_output($XML->GetElement($Reflectors[$i], "name"));
      $COUNTRY       = sanitize_output($XML->GetElement($Reflectors[$i], "country"));
      $LASTCONTACT   = intval($XML->GetElement($Reflectors[$i], "lastcontact"));
      $COMMENT       = sanitize_output($XML->GetElement($Reflectors[$i], "comment"));
      $DASHBOARDURL  = sanitize_attribute($XML->GetElement($Reflectors[$i], "dashboardurl"));
      
      if ($rowcolor == $odrw) {
        $rowcolor = "$prilt";
        }
      
      else {
        $rowcolor = "$odrw";
        }
      
      echo '
      <tr bgcolor="'.$rowcolor.'"
        onMouseOver="this.bgColor=\''.$seclt.'\';"
        onMouseOut="this.bgColor=\''.$rowcolor.'\';"
        style="cursor:pointer" onclick=window.open("'.$DASHBOARDURL.'")>
        
        <td>'.($i+1).'</td>
        <td>'.$NAME.'</td>
        <td>'.$COUNTRY.'</td>
        <td><img src="./img/';
          if ($LASTCONTACT<(time()-1800)) {
            echo 'down';
            }

          else {
            echo 'up';
            }
          
          echo '.svg" width="25">
          </td>
        
        <td align="left">'.$COMMENT.'</td>
      
      </tr>';
      
      }
    
    ?>

</table>
