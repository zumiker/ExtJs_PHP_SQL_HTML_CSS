<?php


define('DEFAULT_CHARSET', 'WINDOWS-1251');

$ajax_params = array();
parse_str($_POST['params'], $ajax_params);

$action = isset($_GET['act']) ? $_GET['act'] : '';

$return = array();

		print_r($ajax_params);
		

function json_safe_encode($var)
{
    return json_encode(json_fix_cyr($var));
}

function json_fix_cyr($var)
{
    if (is_array($var)) {
        $new = array();
        foreach ($var as $k => $v) {
            $new[json_fix_cyr($k)] = json_fix_cyr($v);
        }
        $var = $new;
    } elseif (is_object($var)) {
        $vars = get_class_vars(get_class($var));
        foreach ($vars as $m => $v) {
            $var->$m = json_fix_cyr($v);
        }
    } elseif (is_string($var)) {
        $var = @iconv(DEFAULT_CHARSET, 'utf-8', $var);
    }
    return $var;
}

function decodeParam(&$params, $name)
{
	if (isset($params[$name]))
	{
		$params[$name] = @iconv('UTF-8', 'WINDOWS-1251', urldecode($params[$name]));
	}
}
?>