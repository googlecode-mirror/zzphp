<?php

require_once 'ZZ/FuncaoInvalidaException.php';
require_once 'ZZ/SaidaInvalidaException.php';
require_once 'ZZ/ResultSet.php';

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

    public static function funcoeszz($funcao, $tipoDeResultado, array $argumentos=array())
    {
        if (!ctype_alnum($funcao)) {
            throw new ZZ_FuncaoInvalidaException($funcao, 1);
        }
        if (!method_exists('ZZ_ResultSet', $tipoDeResultado)) {
            throw new ZZ_SaidaInvalidaException($tipoDeResultado);
        }
        $shellArgs = implode(' ', $argumentos);
        $zzsaida = shell_exec("funcoeszz $funcao $shellArgs");
        if (false !== strpos($zzsaida, 'Função inexistente')) {
            throw new ZZ_FuncaoInvalidaException($funcao, 2);
        }
        return new ZZ_ResultSet($zzsaida, $tipoDeResultado);
    }

    public static function alfabeto($tipo, $palavra)
    {
        return self::funcoeszz(
            'alfabeto',
            ZZ_ResultSet::ARR,
            array("--$tipo", $palavra)
        );
    }

    public static function dolar()
    {
        return self::funcoeszz(
            'dolar',
            ZZ_ResultSet::TABELA
        );
    }

    public static function moeda()
    {
        return self::funcoeszz(
            'moeda',
            ZZ_ResultSet::TABELA
        );
    }

    public static function whoisbr($alvo)
    {
        return self::funcoeszz(
            'whoisbr',
            ZZ_ResultSet::LISTA,
            array($alvo)
        );
    }

}