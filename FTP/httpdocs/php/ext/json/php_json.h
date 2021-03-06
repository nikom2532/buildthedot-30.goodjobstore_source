/*
  +----------------------------------------------------------------------+
  | PHP Version 5                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2009 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Author: Omar Kilani <omar@php.net>                                   |
  +----------------------------------------------------------------------+
*/

/* $Id: php_json.h,v 1.8.2.2.2.7 2009/05/31 18:55:10 andrei Exp $ */

#ifndef PHP_JSON_H
#define PHP_JSON_H

#define PHP_JSON_VERSION "1.2.1"
#include "ext/standard/php_smart_str.h"

extern zend_module_entry json_module_entry;
#define phpext_json_ptr &json_module_entry

#ifdef ZTS
#include "TSRM.h"
#endif

ZEND_BEGIN_MODULE_GLOBALS(json)
	int error_code;
ZEND_END_MODULE_GLOBALS(json)

#ifdef ZTS
# define JSON_G(v) TSRMG(json_globals_id, zend_json_globals *, v)
#else
# define JSON_G(v) (json_globals.v)
#endif

PHPAPI void php_json_encode(smart_str *buf, zval *val, int options TSRMLS_DC);
PHPAPI void php_json_decode(zval *return_value, char *str, int str_len, zend_bool assoc, long depth TSRMLS_DC);

#endif  /* PHP_JSON_H */

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * End:
 * vim600: noet sw=4 ts=4 fdm=marker
 * vim<600: noet sw=4 ts=4
 */
