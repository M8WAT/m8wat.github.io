<div>

   <table class="listingtable">

      <tr>
         <th>#</th>
         <th>QTH</th>
         <th>Callsign</th>
         <th>Suffix</th>
         <th>Via Node</th>
         <th>Last Heard <small>(UTC)</small></th>
      </tr>

      <?php

         $Reflector->LoadFlags();
         $rowcolor = "";
         for ($i=0;$i<$Reflector->StationCount();$i++) {
            $ShowThisStation = true;
            if ($ShowThisStation) {
               if ($rowcolor == $odrw) {
                  $rowcolor = "$prilt";
                  } 
               else {
                  $rowcolor = "$odrw";
                  }

               echo '
                  <tr bgcolor="'.$rowcolor.'" onMouseOver="this.bgColor=\''.$seclt.'\';" onMouseOut="this.bgColor=\''.$rowcolor.'\';">

                     <td>';
                        if ($i==0 && $Reflector->Stations[$i]->GetLastHeardTime() > (time() - 10)) {
                           echo '<img src="./img/tx.gif" width="20">';
                           }
                        else {
                           echo ($i+1);
                           }
                        echo '
                     </td>

                     <td>';
                        list ($Flag, $Name) = $Reflector->GetFlag($Reflector->Stations[$i]->GetCallSign());
                        if (file_exists("./img/flags/".$Flag.".svg")) {
                           echo '<a href="http://www.aprs.fi/'.sanitize_attribute($Reflector->Stations[$i]->GetCallsignOnly()).'" class="tip" target="_blank"><img src="./img/flags/'.sanitize_attribute($Flag).'.svg"  alt="'.sanitize_attribute($Name).'" /><span>'.sanitize_output($Name).'</span></a>';
                           }
                     echo '</td>

                     <td>
                        <a href="https://www.qrz.com/db/'.sanitize_attribute($Reflector->Stations[$i]->GetCallsignOnly()).'" target="_blank">'.sanitize_output($Reflector->Stations[$i]->GetCallsignOnly()).'</a>
                     </td>

                     <td>'.sanitize_output($Reflector->Stations[$i]->GetSuffix()).'</td>

                     <td>'.sanitize_output($Reflector->Stations[$i]->GetVia());
                        if ($Reflector->Stations[$i]->GetPeer() != $Reflector->GetReflectorName())
                     echo '</td>

                     <td>'.sanitize_output(@date("Y-m-d H:i", $Reflector->Stations[$i]->GetLastHeardTime())).'</td>

                  </tr>';

            }

            if ($i == $PageOptions['LastHeardPage']['LimitTo']) {
               $i = $Reflector->StationCount()+1;
               }

         }

      ?>

   </table>

</div>

<div id="tables">

   <table class="listingtable">

      <?php

         $Modules = $Reflector->GetModules();
         sort($Modules, SORT_STRING);

         echo '<tr>';
            for ($i=0;$i<count($Modules);$i++) {
               if (isset($PageOptions['ModuleNames'][$Modules[$i]])) {
                  echo '<th>'.sanitize_output($PageOptions['ModuleNames'][$Modules[$i]]);
                  if (trim($PageOptions['ModuleNames'][$Modules[$i]]) != "") {
                     echo ' - ';
                     }
                  echo sanitize_output($Modules[$i]).'</th>';
                  }

               else {
                  echo '<th>'.sanitize_output($Modules[$i]).'</th>';
                  }
               }
            echo '</tr>';

         $GlobalPositions = array();

         for ($i=0;$i<count($Modules);$i++) {
            $Users = $Reflector->GetNodesInModulesByID($Modules[$i]);
            $rowcolor = "";
            $UserCheckedArray = array();

            for ($j=0;$j<count($Users);$j++) {
               if ($rowcolor == $odrw) {
                  $rowcolor = "$prilt";
                  }
               else {
                  $rowcolor = "$odrw";
                  }

               $Displayname = $Reflector->GetCallsignAndSuffixByID($Users[$j]);
               echo '<tr bgcolor="'.$rowcolor.'" onMouseOver="this.bgColor=\''.$seclt.'\';" onMouseOut="this.bgColor=\''.$rowcolor.'\';">
                     <td>
                        <a href="http://www.aprs.fi/'.sanitize_attribute($Displayname).'" class="pl" target="_blank">'.sanitize_output($Displayname).'</a>
                     </td>
                  </tr>';

               $UserCheckedArray[] = $Users[$j];
               }

            }

         ?>

   </table>

</div>
