<?php

/**
 * Deputado Analytics (http://deputadoanalytics.com.br/)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link      https://github.com/thackpa/deputadosAnalytics
 *
 */

namespace DA\Scrapper;

/**
 * Classe responsavel por extrair os
 * dados do Deputado
 *
 * @package Scrapper
 */
class Deputado extends Scrapper
{

    /**
     * Retorna um array com os dados dos Deputados e Legislatura
     * @return array
     */
    public function getMainInfo()
    {
        $crawler = $this->request($this->app['config']['url.deputados']);
        $nodes   = $crawler->filter('#formDepAtual');

        $legislatura = $this->getLegislatura($nodes);
        $deputados   = $this->getDeputadosData($nodes);

        return array(
            'legislatura' => $legislatura,
            'deputados' => $deputados
        );
    }

    /**
     * Retorna os dados dos Deputados
     * @param  \Symfony\Component\DomCrawler\Crawler $crawler
     *
     * @return array    Dados dos deputados
     */
    private function getDeputadosData(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $deps = array();
        $deps = $crawler->filter('#deputado > option')->each(function ($node, $i){
            $dep = array();
            if ($i != 0) {
                $dados              = explode('|', $node->attr('value'));
                $dep['nome']   = utf8_decode($dados[0]);
                $dados              = explode('%', $dados[1]);
                $dep['numero'] = $dados[0];
                $dados              = explode('!', $dados[1]);
                $dep['matricula'] = $dados[0];
                $dados              = explode('=', $dados[1]);
                $dep['estado'] = $dados[0];
                $dados              = explode('?', $dados[1]);
                $dep['partido']       = $dados[0];
                $dep['identificacao'] = $dados[1];

                return $dep;
            }
        });
        array_shift($deps);

        return $deps;
    }

    /**
     * Retorna o numero da Legislatura atual
     * @param \Symfony\Component\DomCrawler\Crawler $crawler
     * @return int
     */
    private function getLegislatura(\Symfony\Component\DomCrawler\Crawler $crawler)
    {
        $legislatura = $crawler->filter('#leg')->first();
        return (int) $legislatura->attr('value');
    }

}
