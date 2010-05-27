<?php

require_once 'ZZ/FuncaoInvalidaException.php';
require_once 'ZZ/SaidaInvalidaException.php';

abstract class ZZ
{
    const ALFABETO_MILITAR = 'militar';
    const ALFABETO_RADIO = 'radio';
    const ALFABETO_FONE ='fone';
    const ALFABETO_OTAN ='otan';
    const ALFABETO_ICAO ='icao';
    const ALFABETO_ANSI ='ansi';
    const ALFABETO_ROMANO = 'romano';
    const ALFABETO_LATINO = 'latino';
    const ALFABETO_ROYAL_NAVY = 'royal-navy';
    const ALFABETO_SIGNALESE = 'signalese';
    const ALFABETO_RAF24 = 'raf24';
    const ALFABETO_RAF42 = 'raf42';
    const ALFABETO_RAF = 'raf';
    const ALFABETO_US = 'us';
    const ALFABETO_PORTUGAL = 'portugal';
    const ALFABETO_NAMES = 'names';
    const ALFABETO_LAPD = 'lapd';
    const SAIDA_ARRAY = 'Array';
    const SAIDA_TABULAR = 'Tabular';
    const SAIDA_TEXTO = 'Texto';

    protected static function transformArray($zzsaida)
    {
        return array_filter(explode(PHP_EOL, $zzsaida));
    }

    protected static function transformTexto($zzsaida)
    {
        return trim($zzsaida);
    }

    protected static function transformTabular($zzsaida)
    {
        $linhas = array_filter(explode(PHP_EOL, $zzsaida));
        $cabecalho = array();
        $resultados = array();
        foreach ($linhas as $numero => $linha) {
            if ($numero === 0) {
                $cabecalho = preg_split('#\s+#', $linha);
                continue;
            }
            $cols = preg_split('#\s{2,}#', $linha);
            if (count($cols) !== count($cabecalho)) {
                $cabecalho += array_flip(range(0, count($cols) - 1));
                $cols += array_flip(range(0, count($cabecalho) - 1));
            }
            $resultados[array_shift($cols)] = array_combine(array_slice($cabecalho, 1), $cols);
        }
        return $resultados;
    }

    public static function funcoeszz($funcao, $tratamento, array $argumentos=array())
    {
        if (!ctype_alnum($funcao)) {
            throw new ZZ_FuncaoInvalidaException($funcao, 1);
        }
        $tratamento = array(__CLASS__, "transform$tratamento");
        if (!method_exists($tratamento[0], $tratamento[1])) {
            throw new ZZ_SaidaInvalidaException($tratamento);
        }
        $shellArgs = implode(' ', $argumentos);
        $zzsaida = shell_exec("funcoeszz $funcao $shellArgs");
        $saidaTratada = call_user_func($tratamento, $zzsaida);
        if (false !== strpos($zzsaida, 'Função inexistente')) {
            throw new ZZ_FuncaoInvalidaException($funcao, 2);
        }
        return $saidaTratada;
    }

    public static function alfabeto($tipo, $palavra)
    {
        return self::funcoeszz(
            'alfabeto',
            self::SAIDA_ARRAY,
            array("--$tipo", $palavra)
        );
    }

    public static function dolar()
    {
        return self::funcoeszz(
            'dolar',
            self::SAIDA_TABULAR
        );
    }

    public static function moeda()
    {
        return self::funcoeszz(
            'moeda',
            self::SAIDA_TABULAR
        );
    }

}