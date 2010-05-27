<?php

require_once 'PHPUnit/Framework.php';

require_once dirname(__FILE__) . '/../../library/ZZ.php';

class ZZTest extends PHPUnit_Framework_TestCase
{

    /**
     * @expectedException ZZ_FuncaoInvalidaException
     */
    public function testFuncoeszzNomeInvalido()
    {
        ZZ::funcoeszz('foo#bar%baz', ZZ_ResultSet::ARR);
    }

    /**
     * @expectedException ZZ_FuncaoInvalidaException
     */
    public function testFuncoeszzFuncaoInexistente()
    {
        ZZ::funcoeszz('helloween', ZZ_ResultSet::ARR);
    }

    public function testFuncoeszz()
    {
        $this->assertContains(
            'Ajuda das Funções ZZ',
            (string) ZZ::funcoeszz('ajuda', ZZ_ResultSet::TEXTO)
        );
    }

    public function testAlfabeto()
    {
        $this->assertEquals(
            9,
            count(ZZ::alfabeto(ZZ::ALFABETO_MILITAR, 'Alexandre'))
        );
    }

    public function testDolar()
    {
        $cotacao = ZZ::dolar();
        $this->assertArrayHasKey('comercial', $cotacao->getArrayCopy());
        $this->assertArrayHasKey('paralelo', $cotacao->getArrayCopy());
        $this->assertArrayHasKey('turismo', $cotacao->getArrayCopy());
        $this->miniTesteCotacao($cotacao['comercial']);
        $this->miniTesteCotacao($cotacao['paralelo']);
        $this->miniTesteCotacao($cotacao['turismo']);
        $this->assertEquals($cotacao->comercial, $cotacao['comercial']);
    }

    public function miniTesteCotacao($subcotacao)
    {
        $this->assertArrayHasKey('compra', $subcotacao->getArrayCopy());
        $this->assertArrayHasKey('venda', $subcotacao->getArrayCopy());
        $this->assertArrayHasKey('hora', $subcotacao->getArrayCopy());
    }

    public function testMoeda()
    {
        $moeda = ZZ::moeda();
        foreach ($moeda as $submoeda)
            $this->miniTesteMoeda($submoeda);
    }

    public function miniTesteMoeda($submoeda)
    {
        $this->assertArrayHasKey('compra', $submoeda->getArrayCopy());
        $this->assertArrayHasKey('venda', $submoeda->getArrayCopy());
        $this->assertArrayHasKey('var', $submoeda->getArrayCopy());
        $this->assertArrayHasKey('hora', $submoeda->getArrayCopy());
        $this->assertArrayHasKey('moeda', $submoeda->getArrayCopy());
    }

    public function testWhoisbrDominio()
    {
        $whoisbr = ZZ::whoisbr('google.com.br');
        //amostragem
        $this->assertArrayHasKey('dominio', $whoisbr->getArrayCopy());
        $this->assertArrayHasKey('entidade', $whoisbr->getArrayCopy());
    }

    public function testWhoisbrID()
    {
        $whoisbr = ZZ::whoisbr('COAGO');
        //amostragem
        $this->assertArrayHasKey('id', $whoisbr->getArrayCopy());
        $this->assertArrayHasKey('nome', $whoisbr->getArrayCopy());
        $this->assertArrayHasKey('criado', $whoisbr->getArrayCopy());
    }

    public function testWhoisbrEntidade()
    {
        $whoisbr = ZZ::whoisbr('006.947.284/0001-04');
        //amostragem
        $this->assertArrayHasKey('entidade', $whoisbr->getArrayCopy());
        $this->assertArrayHasKey('criado', $whoisbr->getArrayCopy());
    }

}
