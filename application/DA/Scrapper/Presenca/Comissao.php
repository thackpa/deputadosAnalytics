<?php

namespace DA\Scrapper\Presenca;
use DA\Scrapper\Scrapper;

class Comissao extends Scrapper
{
    private $app;
    
    public function __construct($app)
    {
        $this->app = $app;
        parent::__construct();
    }
    
    public function getPresencas($deputadoId, $lesgislatura, $last3Matricula, $dataInicio, $dataFim)
    {
    
        $url = str_replace(
                    array('%legislatura%', '%last3Matricula%', '%dataInicio%', '%dataFim%', '%numero%'),
                    array($lesgislatura, $last3Matricula, $dataInicio, $dataFim, $deputadoId),
                    $this->app['config']['url.presencaComissoes']
                );
        
        $this->app['monolog']->addInfo(sprintf("Iniciando a extracao para a url %s.", $url));
        
        $crawler = $this->request($url);
        
        $presencas   = $crawler->filter('div#content table.tabela-2 tr'); //seletores css como Jquery
        
        if(count($presencas) == 0) {
            $presencas   = $crawler->filter('table.tabela-1 > tbody > tr');
        }    

        if(count($presencas) == 0) {
            $this->app['monolog']->addInfo(sprintf("Nenhuma informacao encontrada %s.", $url));
            return array();
        }

        
        $dataPresencas = array();
        $pres = array();
        $pres['deputadoId'] = $deputadoId;        
        
        foreach ($presencas as $node) {
                        
            $ths = $node->getElementsByTagName('th');   
            $tds = $node->getElementsByTagName('td');

            if($node->getAttribute('class') == "even") {
                $dates = explode('/', trim(str_replace('Data: ','', $ths->item(0)->nodeValue)));
                $pres['data'] = $dates[2].'-'.$dates[1].'-'.$dates[0];
            } else if($node->getAttribute('class') == "odd"){
                $pres['comissao'] = utf8_decode(trim($tds->item(0)->nodeValue));
                $pres['tipo']     = utf8_decode(trim($tds->item(1)->nodeValue));
                $pres['comportamento']  = utf8_decode(trim($tds->item(2)->nodeValue));
                $dataPresencas[] = $pres;
            }
            
            $this->app['monolog']->addInfo(print_r($pres, true));
        }
        return $dataPresencas;
    }
    
}