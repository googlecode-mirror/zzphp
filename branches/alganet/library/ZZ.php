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
        $cmd = (defined('ZZPATH'))?ZZPATH:"funcoeszz";
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

    public static function tempo($pais, $localidade=null)
    {
        return self::funcoeszz(
            'tempo',
            is_null($localidade) ? ZZ_ResultSet::LISTA : ZZ_ResultSet::TEXTO,
            array_filter(func_get_args())
        );
    }
    public static function senha($length=6){
        return self::funcoeszz(
            'senha',
            ZZ_ResultSet::TEXTO,
            array($length)
            );
    }
    public static function uniq($filepath){
        return self::funcoeszz(
            'uniq',
            ZZ_ResultSet::ARR,
            array($filepath)
        );
    }
    public static function calcula($expr){
        return self::funcoeszz(
            'calcula',
            ZZ_ResultSet::TEXTO,
            array($expr)
        );
    }
    public static function calculaip($ip, $netmask=null){
        $param = Array($ip, $netmask);
        return  self::funcoeszz(
            'calculaip',
            ZZ_ResultSet::LISTA,
            $param
        );
    }
    public static function ajuda($fct=null){
        /* 
            this function just make sense to return text
            Every function from zz have your own help, make sense use this function to provide these help for functions and system.
        */
        if ( is_null($fct)){
            return self::funcoeszz(
              'ajuda',
              ZZ_ResultSet::TEXTO
            );
        }else{
            $rclass = new ReflectionClass('ZZ');
            if (!$rclass->hasMethod($fct))
                throw new ZZ_FuncaoInvalidaException($fct, 3);

            return self::funcoeszz(
                $fct,
                ZZ_ResultSet::TEXTO,
                array('--help')
             );
        }
    }
    public static function carnaval($ano= null){
        return self::funcoeszz(
            'carnaval',
            ZZ_ResultSet::TEXTO,
            array($ano)
        );
    }
    public static function cpf($cpf=null){
        return self::funcoeszz(
            'cpf',
            ZZ_ResultSet::TEXTO,
            array($cpf)
        );
    }
    public static function cnpj($cnpj=null){
        return self::funcoeszz(
            'cnpj',
            ZZ_ResultSet::TEXTO,
            array($cnpj)
        );
    }
    public static function contapalavra($filepath,$word, $ignoreCase=false, $partial=false){
        $param = Array();
        ($ignoreCase)?array_push($param, '-i'):"";
        ($partial)?array_push($param, '-p'):"";
        array_push($param, $word);
        array_push($param, $filepath);
        return self::funcoeszz(
            'contapalavra',
            ZZ_ResultSet::TEXTO,
            $param
        );
    }    

}
