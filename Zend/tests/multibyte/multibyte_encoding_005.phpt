--TEST--
encoding conversion from script encoding into internal encoding
--SKIPIF--
<?php
if (!in_array("detect_unicode", array_keys(ini_get_all()))) {
  die("skip Requires configure --enable-zend-multibyte option");
}
if (!extension_loaded("mbstring")) {
  die("skip Requires mbstring extension");
}
?>
--INI--
mbstring.encoding_translation = On
mbstring.script_encoding=Shift_JIS
mbstring.internal_encoding=UTF-8
--FILE--
<?php
	function \\\($๘)
	{
		echo $๘;
	}

	\\\("h~t@\");
?>
--EXPECT--
ใใฌใใใกใฝ
