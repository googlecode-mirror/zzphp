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

    public function testTempoPais()
    {
        $tempo = ZZ::tempo('brazil');
        //amostragem
        $this->assertArrayHasKey('sbsp', $tempo->getArrayCopy());
        $this->assertArrayHasKey('sbrj', $tempo->getArrayCopy());
    }

    public function testTempoPaisLocalidade()
    {
        $tempo = ZZ::tempo('brazil', 'sbsp');
        //amostragem
        $this->assertContains('Congonhas Aeroporto', (string) $tempo);
    }
    public function testSenha(){
        $this->assertEquals ( strlen(ZZ::senha()),6);
        $this->assertEquals ( strlen(ZZ::senha(10)),10);
    }
    public function testUniq(){
        // I can put here a tmp folder but it depends of SO, so the temporary file was create at same dir of tests and delete after.
        $f = "testeuniq.txt";
    	exec("printf \"primeiro\nprimeiro\n\" > {$f}");
        if (is_file($f)){
        	$ret = ZZ::uniq($f);
        	$this->assertEquals(count($ret), 1);
        	$this->assertEquals('primeiro', $ret[0]);
        	unlink($f);
        }
    }
    public function testCalculaIP(){
        $calculado = ZZ::calculaip('192.168.0.21', 16);
        $this->assertEquals($calculado['end__ip'], '192.168.0.21');
        $this->assertEquals($calculado['mascara'], '255.255.0.0 = 16');
        $this->assertEquals($calculado['rede'], '192.168.0.0 / 16');
    }
    public function testCarnaval(){
        $this->assertEquals('27/02/1979',   ZZ::carnaval('1979')->toString());
        $this->assertEquals('16/02/2010',   ZZ::carnaval('2010')->toString());
    }
    public function testCpf(){
        $this->assertEquals(strlen(ZZ::cpf()), 14);
        $this->assertEquals(utf8_decode('CPF válido'),utf8_decode(ZZ::cpf('111.111.111-11')));
    }
    public function testCnpj(){
        $this->assertEquals(strlen(ZZ::cnpj()), 18);
        $this->assertEquals(utf8_decode('CNPJ válido'), utf8_decode( ZZ::cnpj('12345678000195') ));
    }
    public function testContaPalavra(){
        $f = "testecontapalvra.txt";
    	exec("printf \"palavra\nprimeiro\nsegundo\ncod\ncodi\ncodigo\n\" > {$f}");
        if (is_file($f)){
            $this->assertEquals(1, (int) ZZ::contapalavra($f, 'palavra', true, true)->toString());
            $this->assertEquals(1, (int) ZZ::contapalavra($f, 'palavra', false, true)->toString());
            $this->assertEquals(1, (int) ZZ::contapalavra($f, 'palavra', true, false)->toString());
            $this->assertEquals(1, (int) ZZ::contapalavra($f, 'palavra')->toString());
            $this->assertEquals(3, (int) ZZ::contapalavra($f, 'cod',     false, true)->toString());
        	unlink($f);
        }
    }


}
