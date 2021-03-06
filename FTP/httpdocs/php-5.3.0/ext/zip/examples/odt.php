<?php
/* $Id: odt.php,v 1.1.4.1 2008/05/21 09:27:41 pajoye Exp $ */
$reader = new XMLReader();

$reader->open('zip://' . dirname(__FILE__) . '/test.odt#meta.xml');
$odt_meta = array();
while ($reader->read()) {
	if ($reader->nodeType == XMLREADER::ELEMENT) {
		$elm = $reader->name;
	} else {
		if ($reader->nodeType == XMLREADER::END_ELEMENT && $reader->name == 'office:meta') {
			break;
		}
		if (!trim($reader->value)) {
			continue;
		}
		$odt_meta[$elm] = $reader->value;
	}
}
print_r($odt_meta);
