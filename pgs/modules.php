<table class="listingtable">
  
  <tr>
    <th rowspan="2">Mod<hide>ule</hide></th>
    <th rowspan="2">Name</th>
    <th rowspan="2">Users</th>
    <th colspan="2">DPlus</th>
    <th colspan="2">DExtra</th>
    <th colspan="2">DCS</th>
    <th rowspan="2">DMR</th>
    <th rowspan="2">YSF<br />DG-ID</th>
  </tr>
  
  <tr>
    <th>URCALL</th>
    <th>DTMF</th>
    <th>URCALL</th>
    <th>DTMF</th>
    <th>URCALL</th>
    <th>DTMF</th>
  </tr>

  <?php
    
    $ReflectorNumber = substr($Reflector->GetReflectorName(), 3, 3);
    $NumberOfModules = isset($PageOptions['NumberOfModules']) ? min(max($PageOptions['NumberOfModules'],0),26) : 26;
    $odd = "";
    
    for ($i = 1; $i <= $NumberOfModules; $i++) {
      $module = chr(ord('A')+($i-1));
      
      if ($odd == $odrw) {
        $odd = "$prilt";
        }
      
      else {
        $odd = "$odrw";
        }
      
      echo '
      <tr bgcolor="'.$odd.'"
        onMouseOver="this.bgColor=\''.$seclt.'\';"
        onMouseOut="this.bgColor=\''.$odd.'\';">
        
        <td>'. sanitize_output($module) .'</td>
        <td>'. sanitize_output(empty($PageOptions['ModuleNames'][$module]) ? '-' : $PageOptions['ModuleNames'][$module]) .'</td>
        <td>'. count($Reflector->GetNodesInModulesByID($module)) .'</td>
        <td>'. sanitize_output('REF' . $ReflectorNumber . $module . 'L') .'</td>
        <td>'. sanitize_output(is_numeric($ReflectorNumber) ? '*' . sprintf('%01d',$ReflectorNumber) . (($i<=4)?$module:sprintf('%02d',$i)) : '-') .'</td>
        <td>'. sanitize_output('XRF' . $ReflectorNumber . $module . 'L') .'</td>
        <td>'. sanitize_output(is_numeric($ReflectorNumber) ? 'B' . sprintf('%01d',$ReflectorNumber) . (($i<=4)?$module:sprintf('%02d',$i)) : '-') .'</td>
        <td>'. sanitize_output('DCS' . $ReflectorNumber . $module . 'L') .'</td>
        <td>'. sanitize_output(is_numeric($ReflectorNumber) ? 'D' . sprintf('%01d',$ReflectorNumber) . (($i<=4)?$module:sprintf('%02d',$i)) : '-') .'</td>
        <td>'. sanitize_output(4000+$i) .'</td>
        <td>'. sanitize_output(9+$i) .'</td>
        </tr>';
      
      }
    
    ?>

</table>