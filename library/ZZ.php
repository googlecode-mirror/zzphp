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
    const SAIDA_LISTA = 'Lista';

    protected static function transformArray($zzsaida)
    {
        return array_filter(explode(PHP_EOL, $zzsaida));
    }

    protected static function normalizar($nome)
    {
        $nome = htmlentities(strtolower(utf8_decode($nome)));
        $nome = preg_replace('#&(.)(acute|cedil|circ|ring|tilde|uml);#', '$1', $nome);
        $nome = preg_replace('#^[^A-Za-z0-9]*(.*)#', '$1', $nome);
        $nome = preg_replace('#(.*?)[^A-Za-z0-9]*$#', '$1', $nome);
        $nome = preg_replace('#[^A-Za-z0-9]#', '_', $nome);
        return utf8_encode($nome);
    }

    protected static function transformLista($zzsaida)
    {
        $linhas = self::transformArray($zzsaida);
        $resultados = array();
        foreach ($linhas as $linha) {
            $chaveValor = preg_split('#\s{2,}#', $linha);
            $chaveValor[0] = self::normalizar($chaveValor[0]);
            if (2 !== count($chaveValor))
                continue;
            if (isset($resultados[$chaveValor[0]])) {
                if (is_array($resultados[$chaveValor[0]])) {
                    $resultados[$chaveValor[0]][] = $chaveValor[1];
                } else {
                    $resultados[$chaveValor[0]] = array($resultados[$chaveValor[0]], $chaveValor[1]);
                }
            } else {
                $resultados[$chaveValor[0]] = $chaveValor[1];
            }
        }
        return $resultados;
    }

    protected static function transformTexto($zzsaida)
    {
        return trim($zzsaida);
    }

    protected static function transformTabular($zzsaida)
    {
        $linhas = self::transformArray($zzsaida);
        $cabecalho = array();
        $resultados = array();
        foreach ($linhas as $numero => $linha) {
            if (0 === $numero) {
                $cabecalho = preg_split('#\s+#', $linha);
                continue;
            }
            $cols = preg_split('#\s{2,}#', $linha);
            if (count($cols) !== count($cabecalho)) {
                $cabecalho += array_flip(range(0, count($cols) - 1));
                $cols += array_flip(range(0, count($cabecalho) - 1));
            }
            $cabecalho = array_map(array(__CLASS__, 'normalizar'), $cabecalho);
            $resultados[self::normalizar(array_shift($cols))] = array_combine(array_slice($cabecalho, 1), $cols);
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

    public static function whoisbr($alvo)
    {
        return self::funcoeszz(
            'whoisbr',
            self::SAIDA_LISTA,
            array($alvo)
        );
    }

}