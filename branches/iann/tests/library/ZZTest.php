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
        ZZ::funcoeszz('foo#bar%baz', ZZ::SAIDA_ARRAY);
    }

    /**
     * @expectedException ZZ_FuncaoInvalidaException
     */
    public function testFuncoeszzFuncaoInexistente()
    {
        ZZ::funcoeszz('helloween', ZZ::SAIDA_ARRAY);
    }

    public function testFuncoeszz()
    {
        $this->assertContains(
            'Ajuda das Funções ZZ',
            ZZ::funcoeszz('ajuda', ZZ::SAIDA_TEXTO)
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
        $this->assertArrayHasKey('Comercial', $cotacao);
        $this->assertArrayHasKey('Paralelo', $cotacao);
        $this->assertArrayHasKey('Turismo', $cotacao);
        $this->miniTesteCotacao($cotacao['Comercial']);
        $this->miniTesteCotacao($cotacao['Paralelo']);
        $this->miniTesteCotacao($cotacao['Turismo']);
    }

    public function miniTesteCotacao($subcotacao)
    {
        $this->assertArrayHasKey('compra', $subcotacao);
        $this->assertArrayHasKey('venda', $subcotacao);
        $this->assertArrayHasKey('hora', $subcotacao);
    }

    public function testMoeda()
    {
        $moeda = ZZ::moeda();
        foreach ($moeda as $submoeda) $this->miniTesteMoeda($submoeda);
    }

    public function miniTesteMoeda($submoeda)
    {

        $this->assertArrayHasKey('Compra', $submoeda);
        $this->assertArrayHasKey('Venda', $submoeda);
        $this->assertArrayHasKey('Var.%', $submoeda);
        $this->assertArrayHasKey('Hora', $submoeda);
        $this->assertArrayHasKey('Moeda', $submoeda);
    }

}
