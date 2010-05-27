<?php

require_once 'Exception.php';

class ZZ_SaidaInvalidaException extends ZZ_Exception
{

    public function __construct($saida)
    {
        parent::__construct("Não existe o método {$saida[1]} para formatar a saída de dados");
    }
}