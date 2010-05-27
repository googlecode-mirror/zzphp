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
        $this->assertArrayHasKey('comercial', $cotacao);
        $this->assertArrayHasKey('paralelo', $cotacao);
        $this->assertArrayHasKey('turismo', $cotacao);
        $this->miniTesteCotacao($cotacao['comercial']);
        $this->miniTesteCotacao($cotacao['paralelo']);
        $this->miniTesteCotacao($cotacao['turismo']);
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
        $this->assertArrayHasKey('compra', $submoeda);
        $this->assertArrayHasKey('venda', $submoeda);
        $this->assertArrayHasKey('var', $submoeda);
        $this->assertArrayHasKey('hora', $submoeda);
        $this->assertArrayHasKey('moeda', $submoeda);
    }

    public function testWhoisbrDominio()
    {
        $whoisbr = ZZ::whoisbr('google.com.br');
        $this->assertTrue(is_array($whoisbr));
        //amostragem
        $this->assertArrayHasKey('dominio', $whoisbr);
        $this->assertArrayHasKey('entidade', $whoisbr);
    }

    public function testWhoisbrID()
    {
        $whoisbr = ZZ::whoisbr('COAGO');
        $this->assertTrue(is_array($whoisbr));
        //amostragem
        $this->assertArrayHasKey('id', $whoisbr);
        $this->assertArrayHasKey('nome', $whoisbr);
        $this->assertArrayHasKey('criado', $whoisbr);
    }

    public function testWhoisbrEntidade()
    {
        $whoisbr = ZZ::whoisbr('006.947.284/0001-04');
        $this->assertTrue(is_array($whoisbr));
        //amostragem
        $this->assertArrayHasKey('entidade', $whoisbr);
        $this->assertArrayHasKey('criado', $whoisbr);
    }

}
