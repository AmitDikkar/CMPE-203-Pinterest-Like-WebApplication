<?php defined('BASEPATH') OR exit('No direct script access allowed');


$config['force_https'] = FALSE;


$config['rest_default_format'] = 'xml';


$config['enable_emulate_request'] = TRUE;


$config['rest_realm'] = 'REST API';


$config['rest_auth'] = false;


$config['rest_valid_logins'] = array('admin' => '1234');

$config['rest_ip_whitelist_enabled'] = false;


$config['rest_ip_whitelist'] = '';


$config['rest_database_group'] = 'default';


$config['rest_keys_table'] = 'keys';


$config['rest_enable_keys'] = FALSE;


$config['rest_key_column'] = 'key';


$config['rest_key_length'] = 40;


$config['rest_key_name'] = 'X-API-KEY';

$config['rest_logs_table'] = 'logs';


$config['rest_enable_logging'] = FALSE;


$config['rest_limits_table'] = 'limits';


$config['rest_enable_limits'] = FALSE;


$config['rest_ignore_http_accept'] = FALSE;


$config['rest_ajax_only'] = FALSE;