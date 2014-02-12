<?php
$result = array(
    'success' => false,
    'message' => 'Wrong parameters'
);

ob_start();

if(isset($_GET['action'])) {
    switch($_GET['action']) {
        case('deploy-production'):
            if(isset($_GET['project'])) {
                $result['success'] = true;
                $result['message'] = deploy($_GET['project']);
            } else {
                $result['message'] = 'Project name is not specified';
            }

            break;

    }
}

ob_get_clean();

echo json_encode($result);

function deploy($project) {
    $result = array();
    chdir('/var/projects/');
    exec("/bin/sh deploy-$project.sh 2>&1", $result);
    return $result;
}

function deploy_ssh($project) {
    if (function_exists("ssh2_connect")) {
        if(!($con = ssh2_connect("127.0.0.1", 22))){
            return "Connecting failed";
        } else {
            if(!ssh2_auth_password($con, "root", "FcnfkfD1cnf")) {
                return "Auth failed";
            } else {
                if (!($stream = ssh2_exec($con, "/bin/sh /var/projects/deploy-$project.sh" ))) {
                    return $stream;
                }
            }
        }
    } else {
        return "ssh2_connect not exists";
    }
}