<?php
require_once 'Exception.php';

class ZZ_FuncaoInvalidaException extends ZZ_Exception
{

    public function __construct($funcao, $code=1)
    {
        switch ($code) {
            case 1:
                parent::__construct("'$funcao' não é um nome de função válido", $code);
                break;
            case 2:
                parent::__construct("'$funcao' não é uma função zz válida", $code);
                break;
            case 3:
                parent::__construct("'$funcao' não é uma função coberta por este bind php", $code);
                break;
        }
    }

}