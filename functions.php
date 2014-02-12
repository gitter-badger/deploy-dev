<?php
$base = '/index.php/';

$config = array(
    'root' => '/home/razbakov/www',
    'subdomain' => '.futurity.pro',
);

$projects = array(
    'test' => array(
        'title' => 'Test',
        'git' => 'git@github.com:futurity-pro/test.git',
    ),
    'futurity-website' => array(
        'title' => 'Futurity Website',
        'live' => 'http://futurity.pro/',
        'git' => 'git@github.com:futurity-pro/futurity-website.git',
    ),
);

$url = $_SERVER['PATH_INFO'];

if ($url) {
    list($null, $project, $branch) = explode('/', $url);
}