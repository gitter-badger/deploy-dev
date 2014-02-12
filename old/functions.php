<?php

define('REPOS_CACHE_FILE', 'data/repos.dat');

require "lib/Github/Autoloader.php";
Github_Autoloader::register();

$github = new Github_Client();
$github->authenticate('razbakov', 'V3ufG0k1c', Github_Client::AUTH_HTTP_PASSWORD);

$updated = 0;

if(@$_GET['update'] || !file_exists(REPOS_CACHE_FILE)) {
    $repos = $github->getRepoApi()->getUserRepos('cabinet');
    foreach($repos as $k=>$repo) {
        $branches = $github->get('repos/show/cabinet/'.$repo['name'].'/branches');
        $repos[$k]['branches'] = $branches['branches'];
        $repos[$k]['id'] = strtolower(str_replace('.','-',$repo['name']));
    }

    $repos_cache = json_encode($repos);
    file_put_contents(REPOS_CACHE_FILE, $repos_cache);
    $updated = date('d.m.Y H:i:s');
} else {
    $repos_cache = file_get_contents(REPOS_CACHE_FILE);
    $repos = json_decode($repos_cache, true);
    $updated = date('d.m.Y H:i:s', filemtime(REPOS_CACHE_FILE));
}

if(@$_GET['query']) die;