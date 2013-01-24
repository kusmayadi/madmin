<?php defined('SYSPATH') or die('No direct script access.');

return array(
    'source'            => 'route', // source: query or route
    'key'               => 'page', // key used in query or route param
    'first_page_in_url' => false, // Should the first page shown in url. eg: http://localhost/users/list/1
    'total_per_page'	=> 20
);
