<?php

class ZZ_ResultSet extends ArrayObject
{
    const ARR = 'transformArray';
    const TABELA = 'transformTabela';
    const TEXTO = 'transformTexto';
    const LISTA = 'transformLista';

    protected $original;
    protected $tratamentoPadrao;
    protected $cleanerPatterns = Array(' :');

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

    public function __toString()
    {
        return trim($this->toOriginal());
    }

    public function toString()
    {
        return $this->__toString();
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
            $chaveValor[1] = trim($chaveValor[1], $this->cleanPatterns);
            if (isset($resultados[$chaveValor[0]])) {
                if (is_array($resultados[$chaveValor[0]])) {
                    $resultados[$chaveValor[0]][] = $chaveValor[1];
                } else {
                    $resultados[$chaveValor[0]] = new ArrayObject(
                            array($resultados[$chaveValor[0]], $chaveValor[1]),
                            ArrayObject::ARRAY_AS_PROPS
                    );
                }
            } else {
                $resultados[$chaveValor[0]] = $chaveValor[1];
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
