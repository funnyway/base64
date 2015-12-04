<?php
function isBase64($c) {
	return (is_string($c) || is_numeric($c) || ($c == '+') || ($c == '/'));
}
function base64Decode($encoded_string) {
	$MyBase64_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	$in_len = strlen($encoded_string);
	$i = 0;
	$j = 0;
	$in_ = 0;
	$char_array_4 = array();
	$char_array_3 = array();
	$ret = '';

	while ($in_len-- && ($encoded_string[$in_] != '=') && isBase64($encoded_string[$in_])) {
		$char_array_4[$i++] = $encoded_string[$in_];
		$in_++;
		if ($i == 4) {
			for ($i = 0; $i < 4; $i++) {
				$char_array_4[$i] = strpos($MyBase64_chars, $char_array_4[$i]);
			}

			$char_array_3[0] = ($char_array_4[0] << 2) + (($char_array_4[1] & 0x30) >> 4);
			$char_array_3[1] = (($char_array_4[1] & 0xf) << 4) + (($char_array_4[2] & 0x3c) >> 2);
			$char_array_3[2] = (($char_array_4[2] & 0x3) << 6) + $char_array_4[3];
			for ($i = 0; ($i < 3); $i++) {
				$ret .= chr($char_array_3[$i]);
			}

			$i = 0;
		}
	}
	if ($i) {
		for ($j = $i; $j < 4; $j++) {
			$char_array_4[$j] = 0;
		}

		for ($j = 0; $j < 4; $j++) {
			$char_array_4[$j] = strpos($MyBase64_chars, $char_array_4[$j]);
		}

		$char_array_3[0] = ($char_array_4[0] << 2) + (($char_array_4[1] & 0x30) >> 4);
		$char_array_3[1] = (($char_array_4[1] & 0xf) << 4) + (($char_array_4[2] & 0x3c) >> 2);
		$char_array_3[2] = (($char_array_4[2] & 0x3) << 6) + $char_array_4[3];
		for ($j = 0; ($j < $i - 1); $j++) {
			$ret .= chr($char_array_3[$j]);
		}

	}

	return $ret;
}
