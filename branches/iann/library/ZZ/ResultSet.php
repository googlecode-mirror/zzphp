<?php

class ZZ_ResultSet extends ArrayObject
{
    const ARR = 'transformArray';
    const TABELA = 'transformTabela';
    const TEXTO = 'transformTexto';
    const LISTA = 'transformLista';

    protected $original;
    protected $tratamentoPadrao;
    private $cleanerpatters = Array('/: /');
    
    public function __construct($original, $tratamentoPadrao)
    {
        list($this->original, $this->tratamentoPadrao) = func_get_args();
        $resultado = call_user_func(array($this, $tratamentoPadrao));
        switch ($tratamentoPadrao) {
            case self::ARR:
            case self::TABELA:
            case self::LISTA:
                parent::__construct($resultado, ArrayObject::ARRAY_AS_PROPS);
                break;
        }
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

    public function toOriginal()
    {
        return $this->original;
    }
    /* the __toString magic method just can used if I implicit cast like using echo or print -  Like to have a function to explicit cast the type */
    public function toString(){
        return $this->__toString();
    }
    public function __toString()
    {
        return trim($this->toOriginal());
    }

    protected function transformArray()
    {
        return new ArrayObject(
            array_filter(explode(PHP_EOL, $this->original)),
            ArrayObject::ARRAY_AS_PROPS
        );
    }

    protected function transformLista()
    {
        $linhas = $this->transformArray($this->original);
        $resultados = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
        foreach ($linhas as $linha) {
            $chaveValor = preg_split('#\s{2,}#', $linha);
            $chaveValor[0] = self::normalizar($chaveValor[0]);
            if (2 !== count($chaveValor))
                continue;
            $value =  trim(preg_filter( $this->cleanerpatters,'',$chaveValor[1]));
            if (isset($resultados[$chaveValor[0]])) {
                if (is_array($resultados[$chaveValor[0]])) {
                    $resultados[$chaveValor[0]][] = $value;
                } else {
                    $resultados[$chaveValor[0]] = new ArrayObject(
                            array($resultados[$chaveValor[0]], $value),
                            ArrayObject::ARRAY_AS_PROPS
                    );
                }
            } else {
                $resultados[$chaveValor[0]] = $value;
            }
        }
        return $resultados;
    }

    protected function transformTexto()
    {
        return trim($this->original);
    }

    protected function transformTabela()
    {
        $linhas = $this->transformArray($this->original);
        $cabecalho = array();
        $resultados = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
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
            $resultados[self::normalizar(array_shift($cols))] = new ArrayObject(
                    array_combine(array_slice($cabecalho, 1), $cols),
                    ArrayObject::ARRAY_AS_PROPS
            );
        }
        return $resultados;
    }

}