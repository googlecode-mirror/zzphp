/*
  +----------------------------------------------------------------------+
  | PHP Version 5                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2007 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author:                                                              |
  +----------------------------------------------------------------------+
*/

/* $Id: header,v 1.16.2.1.2.1 2007/01/01 19:32:09 iliaa Exp $ */
#ifdef HAVE_CONFIG_H
#include "config.h"
#endif
#include "stdlib.h"
#include "php.h"
#include "php_ini.h"
#include "ext/standard/info.h"
#include "php_funcoes_zz.h"

/* If you declare any globals in php_funcoes_zz.h uncomment this:
ZEND_DECLARE_MODULE_GLOBALS(funcoes_zz)
*/

/* True global resources - no need for thread safety here */
static int le_funcoes_zz;

/* {{{ funcoes_zz_functions[]
 *
 * Every user visible function must have an entry in funcoes_zz_functions[].
 */
zend_function_entry funcoes_zz_functions[] = {
	PHP_FE(confirm_funcoes_zz_compiled,	NULL)		/* For testing, remove later. */
PHP_FE(zzajuda,NULL)
PHP_FE(zzalfabeto,NULL)
PHP_FE(zzansi2html,NULL)
PHP_FE(zzarrumanome,NULL)
PHP_FE(zzascii,NULL)
PHP_FE(zzbeep,NULL)//sera que rola
PHP_FE(zzbyte,NULL)
PHP_FE(zzcalcula,NULL)
PHP_FE(zzcalculaip,NULL)
PHP_FE(zzchavegpg,NULL)
PHP_FE(zzcinclude,NULL)
PHP_FE(zzcnpj,NULL)
PHP_FE(zzcontapalavra,NULL)
PHP_FE(zzconverte,NULL)
PHP_FE(zzcores,NULL)
PHP_FE(zzcpf,NULL)
PHP_FE(zzdata,NULL)
PHP_FE(zzdetransp,NULL)
PHP_FE(zzdicasl,NULL)
PHP_FE(zzdicbabelfish,NULL)
PHP_FE(zzdicbabylon,NULL)
PHP_FE(zzdicjargon,NULL)
PHP_FE(zzdicportugues,NULL)
PHP_FE(zzdictodos,NULL)
PHP_FE(zzdiffpalavra,NULL)
PHP_FE(zzdolar,NULL)
PHP_FE(zzdominiopais,NULL)
PHP_FE(zzdos2unix,NULL)
PHP_FE(zzecho,NULL)
PHP_FE(zzfoneletra,NULL)
PHP_FE(zzfreshmeat,NULL)
PHP_FE(zzgoogle,NULL)
PHP_FE(zzhora,NULL)
PHP_FE(zzhoracerta,NULL)
PHP_FE(zzhowto,NULL)
PHP_FE(zzipinternet,NULL)
PHP_FE(zzkill,NULL)
PHP_FE(zzlimpalixo,NULL)
PHP_FE(zzlinha,NULL)
PHP_FE(zzlinuxnews,NULL)
PHP_FE(zzlocale,NULL)
PHP_FE(zzloteria,NULL)
PHP_FE(zzmaiores,NULL)
PHP_FE(zzmaiusculas,NULL)
PHP_FE(zzminusculas,NULL)
PHP_FE(zzmoeda,NULL)
PHP_FE(zznatal,NULL)
PHP_FE(zznomefoto,NULL)
PHP_FE(zznoticiaslinux,NULL)
PHP_FE(zznoticiassec,NULL)
PHP_FE(zzpronuncia,NULL)
PHP_FE(zzramones,NULL)
PHP_FE(zzrot13,NULL)
PHP_FE(zzrot47,NULL)
PHP_FE(zzrpmfind,NULL)
PHP_FE(zzsecutiry,NULL)
PHP_FE(zzsenha,NULL)
PHP_FE(zzseq,NULL)
PHP_FE(zzshuffle,NULL)
PHP_FE(zzsigla,NULL)
PHP_FE(zzss,NULL)
PHP_FE(zztempo,NULL)
PHP_FE(zztool,NULL)
PHP_FE(zztrocaarquivos,NULL)
PHP_FE(zztrocaextensao,NULL)
PHP_FE(zztrocapalavra,NULL)
PHP_FE(zzuniq,NULL)
PHP_FE(zzunix2dos,NULL)
PHP_FE(zzwhoisbr,NULL)
PHP_FE(zzwikipedia,NULL)
PHP_FE(zzzz,NULL)


	{NULL, NULL, NULL}	/* Must be the last line in funcoes_zz_functions[] */
};
/* }}} */

/* {{{ funcoes_zz_module_entry
 */
zend_module_entry funcoes_zz_module_entry = {
#if ZEND_MODULE_API_NO >= 20010901
	STANDARD_MODULE_HEADER,
#endif
	"funcoes_zz",
	funcoes_zz_functions,
	PHP_MINIT(funcoes_zz),
	PHP_MSHUTDOWN(funcoes_zz),
	PHP_RINIT(funcoes_zz),		/* Replace with NULL if there's nothing to do at request start */
	PHP_RSHUTDOWN(funcoes_zz),	/* Replace with NULL if there's nothing to do at request end */
	PHP_MINFO(funcoes_zz),
#if ZEND_MODULE_API_NO >= 20010901
	"0.1", /* Replace with version number for your extension */
#endif
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_FUNCOES_ZZ
ZEND_GET_MODULE(funcoes_zz)
#endif

/* {{{ PHP_INI
 */
/* Remove comments and fill if you need to have entries in php.ini
PHP_INI_BEGIN()
    STD_PHP_INI_ENTRY("funcoes_zz.global_value",      "42", PHP_INI_ALL, OnUpdateLong, global_value, zend_funcoes_zz_globals, funcoes_zz_globals)
    STD_PHP_INI_ENTRY("funcoes_zz.global_string", "foobar", PHP_INI_ALL, OnUpdateString, global_string, zend_funcoes_zz_globals, funcoes_zz_globals)
PHP_INI_END()
*/
/* }}} */

/* {{{ php_funcoes_zz_init_globals
 */
/* Uncomment this function if you have INI entries
static void php_funcoes_zz_init_globals(zend_funcoes_zz_globals *funcoes_zz_globals)
{
	funcoes_zz_globals->global_value = 0;
	funcoes_zz_globals->global_string = NULL;
}
*/
/* }}} */

/* {{{ PHP_MINIT_FUNCTION
 */
PHP_MINIT_FUNCTION(funcoes_zz)
{
	/* If you have INI entries, uncomment these lines
	REGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION
 */
PHP_MSHUTDOWN_FUNCTION(funcoes_zz)
{
	/* uncomment this line if you have INI entries
	UNREGISTER_INI_ENTRIES();
	*/
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request start */
/* {{{ PHP_RINIT_FUNCTION
 */
PHP_RINIT_FUNCTION(funcoes_zz)
{
	return SUCCESS;
}
/* }}} */

/* Remove if there's nothing to do at request end */
/* {{{ PHP_RSHUTDOWN_FUNCTION
 */
PHP_RSHUTDOWN_FUNCTION(funcoes_zz)
{
	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION
 */
PHP_MINFO_FUNCTION(funcoes_zz)
{
	php_info_print_table_start();
	php_info_print_table_header(2, "funcoes_zz support", "enabled");
	php_info_print_table_end();

	/* Remove comments if you have entries in php.ini
	DISPLAY_INI_ENTRIES();
	*/
}
/* }}} */


/* Remove the following function when you have succesfully modified config.m4
   so that your module can be compiled into PHP, it exists only for testing
   purposes. */

/* Every user-visible function in PHP should document itself in the source */
/* {{{ proto string confirm_funcoes_zz_compiled(string arg)
   Return a string to confirm that the module is compiled in */
PHP_FUNCTION(zzajuda){

}
char *execZZ(char *cmd ){
  FILE *fp;
  char *retorno;
  char line[255];
  char base[150]=  "/Users/suporte/Desktop/funcoeszz-8.9.sh  ";///home/www-data/funcoeszz-8.9.sh
  fp = popen( strcat (base,cmd),"r"); //zzascii 1 1", "r");
  retorno = (char *)calloc(30000,sizeof(char));
  while ( fgets( line, sizeof line, fp))
  {
	    strcat (line,"\t");
        strcat (retorno,line);
       // strcat(retorno,"ivo \0");
  }
  pclose(fp);
  return retorno;
}
char *trim_right( char *szSource )
{
	char *pszEOS = 0;
	// Set pointer to character before terminating NULL
	pszEOS = szSource + strlen( szSource ) - 1;
	// iterate backwards until non '_' is found
	while( (pszEOS >= szSource) && (*pszEOS == '_') )
	*pszEOS-- = '\0';
	return szSource;
}
PHP_FUNCTION(zzalfabeto){}
PHP_FUNCTION(zzansi2html){}
PHP_FUNCTION(zzarrumanome){}
PHP_FUNCTION(zzascii){
  zval *dados;
  zval *idados;
  char *retorno;
  char *search = "\t";
  char *token,*ttoken;
  char *p,*pp;
  char *valor,*idx;
  char *cmd=(char *)calloc(10,sizeof(char));
  ALLOC_INIT_ZVAL( dados );
  array_init( dados );
  cmd =  " zzascii 1 1";
  retorno = execZZ(cmd);
 int i=0;
 int j=0;
  p = php_strtok_r(retorno, "\t", &token);
  p = php_strtok_r(NULL, "\t", &token);
	        while (p) {
	        	ALLOC_INIT_ZVAL( idados );
        	    array_init( idados );
	        	valor = estrdup(p);
	        	pp = php_strtok_r(valor," ", &ttoken);
	        	i=0;
	        	while(pp){
	        		if (i==0) idx = estrdup(pp);
	        		else
		        	  add_next_index_string(idados,pp,0);
		        	pp = php_strtok_r(NULL," ", &ttoken);
	        		i++;
	        	}
	        	if (i>2)
	        		add_assoc_zval(dados, idx, idados);
	        	p = php_strtok_r(NULL, "\t", &token);
	        }
	RETURN_ZVAL(dados,1,0);
}
PHP_FUNCTION(zzbeep){}//sera que rola
PHP_FUNCTION(zzbyte){}
PHP_FUNCTION(zzcalcula){}
PHP_FUNCTION(zzcalculaip){
	  zval *dados;
	  char *retorno;
	  char *search = "\t";
	  char *token,*ttoken;
	  char *p,*pp;
	  char *valor,*idx;
	  char *cmd=(char *)calloc(40,sizeof(char));
	  ALLOC_INIT_ZVAL( dados );
	  array_init( dados );
	  cmd =  " zzcalculaip 172.17.1.102 255.255.255.0";
	  retorno = execZZ(cmd);
//	  printf("%s",retorno);

	  int i=0;
	 int j=0;
	  p = php_strtok_r(retorno, "\t", &token);
	  p = php_strtok_r(NULL, "\t", &token);
		        while (p) {
		        	pp = php_strtok_r(p,":", &ttoken);
		        	i=0;
		        	while(pp){
		        		if (i==0) idx = estrdup(pp);
		        		else
		        			valor = estrdup(pp);
			        	pp = php_strtok_r(NULL,":", &ttoken);
		        		i++;
		        	}
		        	if (i>=2)
		        		add_assoc_stringl_ex ( dados, idx, 10, valor, 20, 1 );

//		        		add_assoc_string(dados, idx, valor);
		        	p = php_strtok_r(NULL, "\t", &token);
		        }
		RETURN_ZVAL(dados,1,0);

}
PHP_FUNCTION(zzchavegpg){}
PHP_FUNCTION(zzcinclude){}
PHP_FUNCTION(zzcnpj){}
PHP_FUNCTION(zzcontapalavra){}
PHP_FUNCTION(zzconverte){}
PHP_FUNCTION(zzcores){}
PHP_FUNCTION(zzcpf){}
PHP_FUNCTION(zzdata){}
PHP_FUNCTION(zzdetransp){}
PHP_FUNCTION(zzdicasl){}
PHP_FUNCTION(zzdicbabelfish){}
PHP_FUNCTION(zzdicbabylon){}
PHP_FUNCTION(zzdicjargon){}
PHP_FUNCTION(zzdicportugues){}
PHP_FUNCTION(zzdictodos){}
PHP_FUNCTION(zzdiffpalavra){}
PHP_FUNCTION(zzdolar){}
PHP_FUNCTION(zzdominiopais){}
PHP_FUNCTION(zzdos2unix){}
PHP_FUNCTION(zzecho){}
PHP_FUNCTION(zzfoneletra){}
PHP_FUNCTION(zzfreshmeat){}
PHP_FUNCTION(zzgoogle){}
PHP_FUNCTION(zzhora){}
PHP_FUNCTION(zzhoracerta){}
PHP_FUNCTION(zzhowto){}
PHP_FUNCTION(zzipinternet){}
PHP_FUNCTION(zzkill){}
PHP_FUNCTION(zzlimpalixo){}
PHP_FUNCTION(zzlinha){}
PHP_FUNCTION(zzlinuxnews){}
PHP_FUNCTION(zzlocale){}
PHP_FUNCTION(zzloteria){}
PHP_FUNCTION(zzmaiores){}
PHP_FUNCTION(zzmaiusculas){}
PHP_FUNCTION(zzminusculas){}
PHP_FUNCTION(zzmoeda){}
PHP_FUNCTION(zznatal){}
PHP_FUNCTION(zznomefoto){}
PHP_FUNCTION(zznoticiaslinux){}
PHP_FUNCTION(zznoticiassec){}
PHP_FUNCTION(zzpronuncia){}
PHP_FUNCTION(zzramones){}
PHP_FUNCTION(zzrot13){}
PHP_FUNCTION(zzrot47){}
PHP_FUNCTION(zzrpmfind){}
PHP_FUNCTION(zzsecutiry){}
PHP_FUNCTION(zzsenha){}
PHP_FUNCTION(zzseq){}
PHP_FUNCTION(zzshuffle){}
PHP_FUNCTION(zzsigla){}
PHP_FUNCTION(zzss){}
PHP_FUNCTION(zztempo){}
PHP_FUNCTION(zztool){}
PHP_FUNCTION(zztrocaarquivos){}
PHP_FUNCTION(zztrocaextensao){}
PHP_FUNCTION(zztrocapalavra){}
PHP_FUNCTION(zzuniq){}
PHP_FUNCTION(zzunix2dos){}
PHP_FUNCTION(zzwhoisbr){}
PHP_FUNCTION(zzwikipedia){}
PHP_FUNCTION(zzzz){}


PHP_FUNCTION(confirm_funcoes_zz_compiled)
{
	char *arg = NULL;
	int arg_len, len;
	char *strg;

	if (zend_parse_parameters(ZEND_NUM_ARGS() TSRMLS_CC, "s", &arg, &arg_len) == FAILURE) {
		return;
	}

	len = spprintf(&strg, 0, "Congratulations! You have successfully modified ext/%.78s/config.m4. Module %.78s is now compiled into PHP.", "funcoes_zz", arg);
	RETURN_STRINGL(strg, len, 0);
}
/* }}} */
/* The previous line is meant for vim and emacs, so it can correctly fold and
   unfold functions in source code. See the corresponding marks just before
   function definition, where the functions purpose is also documented. Please
   follow this convention for the convenience of others editing your code.
*/


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
