<?php
function isBase64($c) {
	return is_string($c) || is_numeric($c) || $c == '+' || $c == '/';
}
function base64Encode($bytes_to_encode, $in_len) {
	$MyBase64_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	$ret = '';
	$i = 0;
	$j = 0;
	$char_array_3 = array();
	$char_array_4 = array();
	$offset = 0;
	while ($in_len--) {
		$char_array_3[$i++] = $bytes_to_encode[$offset++];
		if ($i == 3) {
			$char_array_4[0] = (ord($char_array_3[0]) & 0xfc) >> 2;
			$char_array_4[1] = ((ord($char_array_3[0]) & 0x03) << 4) + ((ord($char_array_3[1]) & 0xf0) >> 4);
			$char_array_4[2] = ((ord($char_array_3[1]) & 0x0f) << 2) + ((ord($char_array_3[2]) & 0xc0) >> 6);
			$char_array_4[3] = ord($char_array_3[2]) & 0x3f;
			for ($i = 0; ($i < 4); $i++) {
				$ret .= $MyBase64_chars[$char_array_4[$i]];
			}
			$i = 0;
		}
	}
	if ($i) {
		for ($j = $i; $j < 3; $j++) {
			$char_array_3[$j] = '\0';
		}

		$char_array_4[0] = (ord($char_array_3[0]) & 0xfc) >> 2;
		$char_array_4[1] = ((ord($char_array_3[0]) & 0x03) << 4) + ((ord($char_array_3[1]) & 0xf0) >> 4);
		$char_array_4[2] = ((ord($char_array_3[1]) & 0x0f) << 2) + ((ord($char_array_3[2]) & 0xc0) >> 6);
		$char_array_4[3] = ord($char_array_3[2]) & 0x3f;
		for ($j = 0; ($j < $i + 1); $j++) {
			$ret .= $MyBase64_chars[$char_array_4[$j]];
		}

		while (($i++ < 3)) {
			$ret .= '=';
		}

	}
	return $ret;
}

