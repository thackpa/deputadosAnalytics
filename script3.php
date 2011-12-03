<?php
ini_set("error_reporting" , E_ALL & ~E_NOTICE);
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$dbh = new PDO('mysql:host=localhost;dbname=congresso', "root", "");

function getValues($url,$regex){
    $oControle = new Controle();
    $oSpider = $oControle->get_spider();

    $conteudo = $oSpider->get($url);
    if($oSpider->get_error() != NULL){
    	//$msg = $oSpider->get_error();
    	$msg = $oSpider->__get('error');
    }
        
    preg_match_all("#$regex#is",$conteudo,$valor);
    return $valor;
}

$sql = "SELECT * FROM deputado";
$deputados = $dbh->query($sql);

foreach ($deputados as $row) {
    print "Inserindo as presencas.....\n";
    $url = "http://www.camara.gov.br/internet/sileg/Prop_lista.asp?Autor=IDDEP&Limite=N";    
    $url2 = str_replace("IDDEP", $row["idDeputado"], $url);
//Furada!!!
    $regex = "<tbody\sclass=\"coresAlternadas\">\s+<!-.*-->\s+<tr\s+class='(?:even|odd)'>\s+<td>(?:\s+<input\stype=\"checkbox\"\svalue=\"(.*?)\"\sname=\"chkListaProp\"\s/>)?\s+<a\shref=\"Prop_Detalhe.asp\?id=(\d+)\"\sclass=\"rightIconified\siconDetalhe\">(.*?)\s+</a>\s+</td>\s+<td>(.*?)</td>\s+?<td>(.*?)</td>\s+</tr>\s+<!-.*->\s+<tr\sclass='?(?:even|odd)'\s*>\s+<td>.*?</td>\s+<td\scolspan=\"\d+\">\s+<!-.*-->\s+<p><strong>Autor:</strong>\s+(.*?)</p><p><b>Data\sde\sapresenta.*o:\s</b>(\d{1,2}/\d{1,2}/\d{4})<br\s/><b>Ementa:\s</b>(.*?)</p>(?:\s+<b>Despacho:\s*</b>(.*))?";
    //
    //<tr\sclass='(?:even|odd)'\s*>\s+<td>\s</td>\s+<td\scolspan=\"\d+\">\s+<!-.*-->\s+<p><strong>Autor:</strong>\s+(.*?)\s+-\s+(.*?)</p><p><b>Data\sde\sapresenta.*o:\s</b>(\d{1,2}/\d{1,2}/\d{4})<br\s/><b>Ementa:\s</b>(.*?)</p>(?:\s+<b>Despacho:\s*</b>(.*))? 
    $valor = getValues($url2, $regex);
    for($i=0;$i<count($valor[0]);$i++){
        print "1 - ".$valor[1][$i]."\n";
        print "2 - ".$valor[2][$i]."\n";
        print "3 - ".$valor[3][$i]."\n";
        print "4 - ".$valor[4][$i]."\n";
        print "5 - ".$valor[5][$i]."\n";
        print "6 - ".$valor[6][$i]."\n";
        print "7 - ".$valor[7][$i]."\n";
        
        if($i==10)
            die;
    }
    print "\n\n\n\n\npresencas de dias inseridas....";
}