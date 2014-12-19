<?php
include("destinations.php");

$action = ($_POST['action'])?$_POST['action']:'';

$salida ='';
switch($action){
    case "getPortStatus":
        
        $salida = '';
        $timeout=1;
        $numcols = 2;
        $numrows = 12;
        $colscount = 0;
        $servicio = '(Charlie USA)';
        

        if(!count($dest[0])==0){
            $salida .= "<table style='float:left' border='0' cellpadding='0' cellspacing='0' id='product-table'><tr><td valign='top'>";
                    
                
                $serverscount = count($dest);
                $globalCount = 0;

                for( $i=0; $i<$serverscount; $i++ ){
                
                $portscount = count($dest[$i]);
                
                        for( $x=1; $x<$portscount; $x++ ){
                
                                $server = $dest[$i][0];
                                $port   = $dest[$i][$x];
                                
                                $connect = @fsockopen($server,$port,$errno,$errstr,$timeout);
                                $status  = "DOWN";
                                
                                if($dest[$i][$x] == 40000){
                                	$servicio = '(Red Point 125W)';
                                }
                                elseif($dest[$i][$x] == 45000){
                                	$servicio = '(Amazonas)';
                                }
                        		elseif($dest[$i][$x] == 50000){
                                	$servicio = '(Beverly)';
                                }
                                elseif($dest[$i][$x] == 55000){
                                	$servicio = '(Charlie Mexico)';
                                }
                                elseif($dest[$i][$x] == 60000){
                                	$servicio = '(Blue Sky)';
                                }
                                elseif($dest[$i][$x] == 65000){
                                	$servicio = '(Red Point 50W)';
                                }
                                if(!$connect){
                
                                        $status = "DOWN";
                
                                }else{
                
                
                                        $status = "UP";
                
                                }
                                        
                                $img = ($status=="UP")?'http://www.iksnumbers.com/_/images/misc/live.png':'http://www.iksnumbers.com/_/images/misc/offline.png';
                                
                                if (!($globalCount%$numrows) and $globalCount>0) {
                                        $salida.= '</td><td valign="top">'; // start a new row
                                }
                                
                                $salida.= "<div> <b>$servicio</b> &nbsp".$dest[$i][0].":".$dest[$i][$x]."&nbsp;<img src='$img'></div>";
                                $globalCount++;
                
                        }
                
                
                }
                    
                $salida .= "</td></tr></table>";
        }// fin de si hay pregunta
        else{
          $salida = "";
        }
    break;
}
echo $salida;
?>    
