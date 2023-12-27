<?php
	function checkIP($allow_regex_ips = array(), $allow_ips = array()) {
		$is_regex_valid = false;
        foreach ($allow_regex_ips as $regex_ip) {
            if(!preg_match($regex_ip, $_SERVER['REMOTE_ADDR'])) continue;

            $is_regex_valid = true;
            break;
        }

        if(!$is_regex_valid && !in_array($_SERVER['REMOTE_ADDR'], $allow_ips))
            return exit('failed IP');
	}

checkIP(array(
    '/^121\\.135\\.205\\.52$/',
	'/^220\\.121\\.60\\..+$/',
    '/^121\\.142\\.213\\..+$/',
    '/^211\\.248\\.110\\..+$/',
    '/^220\\.121\\.51\\..+$/',
    '/^220\\.121\\.60\\..+$/',
    '/^211\\.248\\.113\\..+$/',
    '/^211\\.248\\.111\\..+$/',
    '/^14\\.37\\.62\\..+$/',
    '/^211\\.248\\.112\\..+$/',
    '/^221\\.165\\.64\\..+$/',
    '/^175\\.210\\.150\\.79$/',
    '/^121\\.172\\.243\\..+$/',
    '/^222\\.100\\.234\\.208$/',  //  강슬기 220218
    '/^175\\.210\\.150\\.35$/',  //  강슬기 220303
    '/^175\\.210\\.165\\.164$/',  // 최하정 사원 요청 220615
));

