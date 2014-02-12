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
        'git' => 'git@github.com:futurity-pro/futurity-website.git',
    ),
);

$url = $_SERVER['PATH_INFO'];

if ($url) {
    list($null, $project, $branch) = explode('/', $url);
}

if($project == 'config') {
    $project = false;
} else {
    $config = false;
}