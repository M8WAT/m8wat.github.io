
      <table class="listingtable">

         <tr>
            <th>#</th>
            <th>QTH</th>
            <th><hide>DV </hide>Station</th>
            <th>Band</th>
            <hide><th>Last Heard<small> (UTC)</small></th></hide>
            <th>Linked for</th>
            <th>Protocol</th>
         </tr>

         <?php

         $rowcolor = "";
         $Reflector->LoadFlags();

         for ($i=0;$i<$Reflector->NodeCount();$i++) {
            $ShowThisStation = true;

            if ($ShowThisStation) {
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
                  style="cursor:pointer" onclick=window.open("http://www.aprs.fi/'.$Reflector->Nodes[$i]->GetCallSign();
                  if ($Reflector->Nodes[$i]->GetSuffix() != "") echo '-'.$Reflector->Nodes[$i]->GetSuffix();
                  echo '")>

                  <td>'.($i+1).'</td>

                  <td>';
                  list ($Flag, $Name) = $Reflector->GetFlag($Reflector->Nodes[$i]->GetCallSign());
                  if (file_exists("./img/flags/".$Flag.".svg")) {
                     echo '<a href="#" class="tip">
                        <img src="https://m8wat.github.io/reflector/img/flags/'.sanitize_attribute($Flag).'.svg" alt="'.sanitize_attribute($Name).'" />
                           <span>'.sanitize_output($Name).'</span>
                        </a>';
                     }
                  echo '</td>

                  <td>
                  '.sanitize_attribute($Reflector->Nodes[$i]->GetCallSign());
                  if ($Reflector->Nodes[$i]->GetSuffix() != "") {
                     echo '-'.sanitize_output($Reflector->Nodes[$i]->GetSuffix());
                     }
                  echo '</td>

                  <td>';
                  if (($Reflector->Nodes[$i]->GetPrefix() == 'REF') || ($Reflector->Nodes[$i]->GetPrefix() == 'XRF')) {
                     switch ($Reflector->Nodes[$i]->GetPrefix()) {
                        case 'REF'  : echo 'REF-Link'; break;
                        case 'XRF'  : echo 'XRF-Link'; break;
                        }
                     }

                  else {
                     switch ($Reflector->Nodes[$i]->GetSuffix()) {
                        case 'A' : echo '23cm'; break;
                        case 'B' : echo '70cm'; break;
                        case 'C' : echo '2m'; break;
                        case 'D' : echo 'Peanut'; break;
                        case 'G' : echo 'Internet-Gateway'; break;
                        default  : echo '';
                        }
                     echo '</td>

                     <hide><td>'.sanitize_output(date("Y-m-d H:i", $Reflector->Nodes[$i]->GetLastHeardTime())).'</td></hide>
                     <td>'.sanitize_output(FormatSeconds(time()-$Reflector->Nodes[$i]->GetConnectTime())).'</td>
                     <td>'.sanitize_output($Reflector->Nodes[$i]->GetProtocol()).'</td>';
                     }

                  echo '
                  </tr>';
                  }

            if ($i == $PageOptions['RepeatersPage']['LimitTo']) {
               $i = $Reflector->NodeCount()+1;
               }

            }

         ?>

      </table>

