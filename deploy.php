<pre>
<?php
$result = array();
exec("git stash 2>&1", $result);
exec("git pull origin dev 2>&1", $result);
print_r($result);
