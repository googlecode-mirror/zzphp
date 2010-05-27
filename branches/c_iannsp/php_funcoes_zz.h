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

#ifndef PHP_FUNCOES_ZZ_H
#define PHP_FUNCOES_ZZ_H

extern zend_module_entry funcoes_zz_module_entry;
#define phpext_funcoes_zz_ptr &funcoes_zz_module_entry

#ifdef PHP_WIN32
#define PHP_FUNCOES_ZZ_API __declspec(dllexport)
#else
#define PHP_FUNCOES_ZZ_API
#endif

#ifdef ZTS
#include "TSRM.h"
#endif

PHP_MINIT_FUNCTION(funcoes_zz);
PHP_MSHUTDOWN_FUNCTION(funcoes_zz);
PHP_RINIT_FUNCTION(funcoes_zz);
PHP_RSHUTDOWN_FUNCTION(funcoes_zz);
PHP_MINFO_FUNCTION(funcoes_zz);

PHP_FUNCTION(confirm_funcoes_zz_compiled);	/* For testing, remove later. */
char *ExecZZ(char *cmd);
PHP_FUNCTION(zzajuda);
PHP_FUNCTION(zzalfabeto);
PHP_FUNCTION(zzansi2html);
PHP_FUNCTION(zzarrumanome);
PHP_FUNCTION(zzascii);
PHP_FUNCTION(zzbeep);//sera que rola
PHP_FUNCTION(zzbyte);
PHP_FUNCTION(zzcalcula);
PHP_FUNCTION(zzcalculaip);
PHP_FUNCTION(zzchavegpg);
PHP_FUNCTION(zzcinclude);
PHP_FUNCTION(zzcnpj);
PHP_FUNCTION(zzcontapalavra);
PHP_FUNCTION(zzconverte);
PHP_FUNCTION(zzcores);
PHP_FUNCTION(zzcpf);
PHP_FUNCTION(zzdata);
PHP_FUNCTION(zzdetransp);
PHP_FUNCTION(zzdicasl);
PHP_FUNCTION(zzdicbabelfish);
PHP_FUNCTION(zzdicbabylon);
PHP_FUNCTION(zzdicjargon);
PHP_FUNCTION(zzdicportugues);
PHP_FUNCTION(zzdictodos);
PHP_FUNCTION(zzdiffpalavra);
PHP_FUNCTION(zzdolar);
PHP_FUNCTION(zzdominiopais);
PHP_FUNCTION(zzdos2unix);
PHP_FUNCTION(zzecho);
PHP_FUNCTION(zzfoneletra);
PHP_FUNCTION(zzfreshmeat);
PHP_FUNCTION(zzgoogle);
PHP_FUNCTION(zzhora);
PHP_FUNCTION(zzhoracerta);
PHP_FUNCTION(zzhowto);
PHP_FUNCTION(zzipinternet);
PHP_FUNCTION(zzkill);
PHP_FUNCTION(zzlimpalixo);
PHP_FUNCTION(zzlinha);
PHP_FUNCTION(zzlinuxnews);
PHP_FUNCTION(zzlocale);
PHP_FUNCTION(zzloteria);
PHP_FUNCTION(zzmaiores);
PHP_FUNCTION(zzmaiusculas);
PHP_FUNCTION(zzminusculas);
PHP_FUNCTION(zzmoeda);
PHP_FUNCTION(zznatal);
PHP_FUNCTION(zznomefoto);
PHP_FUNCTION(zznoticiaslinux);
PHP_FUNCTION(zznoticiassec);
PHP_FUNCTION(zzpronuncia);
PHP_FUNCTION(zzramones);
PHP_FUNCTION(zzrot13);
PHP_FUNCTION(zzrot47);
PHP_FUNCTION(zzrpmfind);
PHP_FUNCTION(zzsecutiry);
PHP_FUNCTION(zzsenha);
PHP_FUNCTION(zzseq);
PHP_FUNCTION(zzshuffle);
PHP_FUNCTION(zzsigla);
PHP_FUNCTION(zzss);
PHP_FUNCTION(zztempo);
PHP_FUNCTION(zztool);
PHP_FUNCTION(zztrocaarquivos);
PHP_FUNCTION(zztrocaextensao);
PHP_FUNCTION(zztrocapalavra);
PHP_FUNCTION(zzuniq);
PHP_FUNCTION(zzunix2dos);
PHP_FUNCTION(zzwhoisbr);
PHP_FUNCTION(zzwikipedia);
PHP_FUNCTION(zzzz);

/* 
  	Declare any global variables you may need between the BEGIN
	and END macros here:     

ZEND_BEGIN_MODULE_GLOBALS(funcoes_zz)
	long  global_value;
	char *global_string;
ZEND_END_MODULE_GLOBALS(funcoes_zz)
*/

/* In every utility function you add that needs to use variables 
   in php_funcoes_zz_globals, call TSRMLS_FETCH(); after declaring other 
   variables used by that function, or better yet, pass in TSRMLS_CC
   after the last function argument and declare your utility function
   with TSRMLS_DC after the last declared argument.  Always refer to
   the globals in your function as FUNCOES_ZZ_G(variable).  You are 
   encouraged to rename these macros something shorter, see
   examples in any other php module directory.
*/

#ifdef ZTS
#define FUNCOES_ZZ_G(v) TSRMG(funcoes_zz_globals_id, zend_funcoes_zz_globals *, v)
#else
#define FUNCOES_ZZ_G(v) (funcoes_zz_globals.v)
#endif

#endif	/* PHP_FUNCOES_ZZ_H */


/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
