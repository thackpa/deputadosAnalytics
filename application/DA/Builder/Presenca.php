<?php

namespace DA\Builder;

class Presenca extends Builder
{
    protected $presencaScrapper;
    protected $presencaRepository;
    protected $legislaturaRepository;
    protected $deputadoRepository;
    
    /**
     * Inicializa as principais variaveis para realização da exração e armazenamento no BD
     * @param Silex\Application $app                        
     */
    public function __construct($app)
    {
        parent::__construct($app);                
    }

    /**
     * Tranforma o mes passado como parametro em um array 
     * contendo o primeiro e ultimo dia deste mes.
     * 
     * @param  int $mes 
     * @return array  array('dataInicio'=>'01/$mes/$ano', 'dataFim'=>'$endDay/$mes/$ano');
     */
    protected function getDatas4Extracao($mes)
    {
        $endDay = 31;

        if($mes == 2) {
            $endDay = 28;
        }elseif($mes % 2 == 0) {
            $endDay = 30;
        }

        $ano = date('Y');
        $mes = str_pad($mes, 2, "0", STR_PAD_LEFT);
        
        return array("dataInicio" => "01/$mes/$ano", "dataFim" => "$endDay/$mes/$ano");
    }

    /**
     * Extrai e atualiza no banco as Presencas
     * @param  int $mes mes que será feita a extração
     * @return void      
     */
    public function atualizarPresencas($mes = null)
    { 
        if(is_null($mes)) {
            $mes = date("m");
        }
        
        $datas = $this->getDatas4Extracao($mes);
        
        $legislatura = $this->legislaturaRepository->getLegislaturaAtual();
        $deputados = $this->deputadoRepository->getDeputadosAtuais();
        
        foreach ($deputados as $deputado) {
            
            $this->app['monolog']->addInfo(sprintf("Iniciando a extracao para o deputado %s.", $deputado['nome']));
            
            $presencas = $this->presencaScrapper->getPresencas($deputado['id'], $legislatura['numero'], substr($deputado['matricula'], -3), $datas['dataInicio'], $datas['dataFim']);
            
            $this->app['monolog']->addInfo(sprintf("Recuperado %s presencas para o deputado %s.", count($presencas), $deputado['nome']));
            
            $retorno = $this->presencaRepository->savePresencas($presencas);
            
            $this->app['monolog']->addInfo(sprintf("Salvo %s presencas.", count($retorno)));
        }       
    }    
}