<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$configuration['main_url']	= 'http://localhost/TagIt.com';
$configuration['index_page'] = '';
$configuration['uri_protocol']	= 'AUTO';

$configuration['url_suffix'] = '';
$configuration['lang']	= 'english';

$configuration['charset'] = 'UTF-8';
$configuration['enable_hooks'] = FALSE;

$configuration['subclass_prefix'] = 'MY_';

$configuration['permitted_uri_chars'] = 'a-z 0-9~%.:_\-=';
$configuration['allow_get_array']		= TRUE;
$configuration['enable_query_strings'] = FALSE;
$configuration['controller_trigger']	= 'c';
$configuration['function_trigger']		= 'm';
$configuration['directory_trigger']	= 'd'; 
$configuration['log_threshold'] = 0;
$configuration['log_path'] = '';
$configuration['log_date_format'] = 'Y-m-d H:i:s';
$configuration['cache_path'] = '';
$configuration['encryption_key'] = 'abcd';

$configuration['sess_cookie_name']		= 'ci_session';
$configuration['sess_expiration']		= 7200;
$configuration['sess_expire_on_close']	= FALSE;
$configuration['sess_encrypt_cookie']	= FALSE;
$configuration['sess_use_database']	= FALSE;
$configuration['sess_table_name']		= 'ci_sessions';
$configuration['sess_match_ip']		= FALSE;
$configuration['sess_match_useragent']	= TRUE;
$configuration['sess_time_to_update']	= 300;

$configuration['cookie_prefix']	= "";
$configuration['cookie_domain']	= "";
$configuration['cookie_path']		= "/";
$configuration['cookie_secure']	= FALSE;
$configuration['global_xss_filtering'] = FALSE;
$configuration['csrf_protection'] = FALSE;
$configuration['csrf_token_name'] = 'csrf_test_name';
$configuration['csrf_cookie_name'] = 'csrf_cookie_name';
$configuration['csrf_expire'] = 7200;
$configuration['compress_output'] = FALSE;
$configuration['time_reference'] = 'local';
$configuration['rewrite_short_tags'] = FALSE;
$configuration['proxy_ips'] = '';


$configuration['pin_load_limit'] = 20;