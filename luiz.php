<?php 

$sql = '<tr> 
                                            <td colspan="6"><strong>Data: <span>24/11/2010</span></strong></td> 
                                        </tr> 
                                        
                                        
                                            <tr> 
                                                <th><b>Comiss&atilde;o</b></th> 
                                                <th><b>Tipo de Reuni&atilde;o</b></th> 
                                                <th><b>Freq&uuml;&ecirc;ncia</b></th> 
                                            </tr> 
                                            <tr
    class="grid-line even"> 
                                                <td><span>Titular - CAPADR - AGRICULTURA, PECUÁRIA, ABASTECIMENTO DESENV. RURAL</span></td> 
                                                <td><span>Reunião Deliberativa</span></td> 
                                                <td><span>Presença</span> 
                                                    
                                                    
                                                    
                                                </td> 
                                            </tr> 
                                    
                                    
                                        <tr> 
                                            <td colspan="6"><strong>Data: <span>01/12/2010</span></strong></td> 
                                        </tr> 
                                        
                                        
                                            <tr> 
                                                <th><b>Comiss&atilde;o</b></th> 
                                                <th><b>Tipo de Reuni&atilde;o</b></th> 
                                                <th><b>Freq&uuml;&ecirc;ncia</b></th> 
                                            </tr> 
                                            <tr
    class="grid-line even"> 
                                                <td><span>Titular - CAPADR - AGRICULTURA, PECUÁRIA, ABASTECIMENTO DESENV. RURAL</span></td> 
                                                <td><span>Reunião Deliberativa</span></td> 
                                                <td><span>Presença</span> 
                                                    
                                                    
                                                    
                                                </td> 
                                            </tr> 
                                    
                                    
                                        
                                        
                                        
                                            
                                            <tr
    class="grid-line odd"> 
                                                <td><span>Titular - CAPADR - AGRICULTURA, PECUÁRIA, ABASTECIMENTO DESENV. RURAL</span></td> 
                                                <td><span>Audiência Pública</span></td> 
                                                <td><span>Presença</span> 
                                                    
                                                    
                                                    
                                                </td> 
                                            </tr> 
                                    
                            </table>  ';


$regex = "<strong>.*?\s*?<span>(\d+)/(\d+)/(\d\d\d\d)</span></strong></td>\s*?</tr>(.*?)(?:colspan|</table>)";

preg_match_all("#$regex#is",$sql,$valor);

print_r($valor);




#ALguma coisa
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();
//print "<xmp>";print_r($oSpider);print "</xmp>";
$oSpider = $oControle->get_spider();
$url = "http://www.camara.gov.br/internet/sileg/Prop_lista.asp?Autor=521607&Limite=N";
//print "@@$url";
$conteudo = $oSpider->get($url);
//print $conteudo; exit;
if($oSpider->get_error() != NULL){
       //$msg = $oSpider->get_error();
       $msg = $oSpider->__get('error');
} else {
               
       if(preg_match_all("#<tbody class=\"coresAlternadas\">\s+<!-.*-->\s+<tr\s+class='(?:even|odd)'>\s+<td>(?:\s+<input type=\"checkbox\" value=\"(.*?)\" name=\"chkListaProp\" />)?\s+<a href=\"Prop_Detalhe.asp\?id=(\d+)\" class=\"rightIconified iconDetalhe\">(.*?)\s+</a>\s+</td>\s+<td>(.*?)</td>\s+<td>(.*?)</td>\s+</tr>\s+<!-.*->\s+<tr class='(?:even|odd)'\s*>\s+<td> </td>\s+<td colspan=\"\d+\">\s+<!-.*-->\s+<p><strong>Autor:</strong>\s+(.*?)\s+-\s+(.*?)</p><p><b>Data de apresenta.*o: </b>(\d{1,2}/\d{1,2}/\d{4})<br /><b>Ementa: </b>(.*?)</p>(?:\s+<b>Despacho:\s*</b>(.*))?#i", $conteudo, $aValor)){
               //echo "<xmp>"; print_r($aValor); echo "</xmp>"; exit;
               $qtd = count($aValor[1]);
               for($i=0; $i<$qtd; $i++){
                       $aDado[$i]['cod1'] = $aValor[1][$i];
                       $aDado[$i]['cod2'] = $aValor[2][$i];
                       $aDado[$i]['proposicao'] = $aValor[3][$i];
                       $aDado[$i]['orgao'] = $aValor[4][$i];
                       $aDado[$i]['situacao'] = $aValor[5][$i];
                       $aDado[$i]['autor'] = $aValor[6][$i];
                       $aDado[$i]['partido'] = $aValor[7][$i];
                       $aDado[$i]['data_apresentacao'] = $aValor[8][$i];
                       $aDado[$i]['ementa'] = $aValor[9][$i];
                       $aDado[$i]['despacho'] = $aValor[10][$i];
               }
               //print "<xmp>"; print_r($aValor); print "</xmp>";        
               //print "<xmp>"; print_r($aDado); print "</xmp>";exit;
       } else {
                       $msg = "Nenhum item encontrado";
       }
}
//print "<xmp>";print_r($oSpider);print "</xmp>";
?>
<table>
<?php 
if(count($aDado)>0){
?>
<tr>
       <th>Codigo1</th>
       <th>Codigo2</th>
       <th>Proposicao</th>
       <th>Orgao</th>
       <th>Situacao</th>
       <th>Autor</th>
       <th>Parti