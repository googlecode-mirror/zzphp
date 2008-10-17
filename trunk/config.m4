dnl $Id$
dnl config.m4 for extension funcoes_zz


 PHP_ARG_WITH(funcoes_zz, for funcoes_zz support,
 [  --with-funcoes_zz             Include funcoes_zz support])

dnl Otherwise use enable:

 PHP_ARG_ENABLE(funcoes_zz, whether to enable funcoes_zz support,
 [  --enable-funcoes_zz           Enable funcoes_zz support])

if test "$PHP_FUNCOES_ZZ" != "no"; then
  dnl Write more examples of tests here...

   # --with-funcoes_zz -> check with-path
   SEARCH_PATH="/Users/suporte/C_workspace/funcoes_zz"     # you might want to change this
   SEARCH_FOR="php_funcoes_zz.h"  # you most likely want to change this
   if test -r $PHP_FUNCOES_ZZ/$SEARCH_FOR; then # path given as parameter
     FUNCOES_ZZ_DIR=$PHP_FUNCOES_ZZ
   else # search default path list
     AC_MSG_CHECKING([for funcoes_zz files in default path])
     for i in $SEARCH_PATH ; do
       if test -r $i/$SEARCH_FOR; then
         FUNCOES_ZZ_DIR=$i
         AC_MSG_RESULT(found in $i)
       fi
     done
   fi
  
  if test -z "$FUNCOES_ZZ_DIR"; then
     AC_MSG_RESULT([not found])
     AC_MSG_ERROR([Please reinstall the funcoes_zz distribution])
   fi

  dnl # --with-funcoes_zz -> add include path
   PHP_ADD_INCLUDE($FUNCOES_ZZ_DIR/include)

  dnl # --with-funcoes_zz -> check for lib and symbol presence
   LIBNAME=funcoes_zz # you may want to change this
   LIBSYMBOL=funcoes_zz # you most likely want to change this 

  dnl PHP_CHECK_LIBRARY($LIBNAME,$LIBSYMBOL,
  dnl [
  dnl   PHP_ADD_LIBRARY_WITH_PATH($LIBNAME, $FUNCOES_ZZ_DIR/lib, FUNCOES_ZZ_SHARED_LIBADD)
  dnl   AC_DEFINE(HAVE_FUNCOES_ZZLIB,1,[ ])
  dnl ],[
  dnl   AC_MSG_ERROR([wrong funcoes_zz lib version or lib not found])
  dnl ],[
  dnl   -L$FUNCOES_ZZ_DIR/lib -lm -ldl
  dnl ])
  dnl
  dnl PHP_SUBST(FUNCOES_ZZ_SHARED_LIBADD)

  PHP_NEW_EXTENSION(funcoes_zz, funcoes_zz.c, $ext_shared)
fi
