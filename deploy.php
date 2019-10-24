<?php
namespace Deployer;

require 'recipe/zend_framework.php';

// Project name
set('application', 'YAWIK-nuxt');

// Project repository
set('repository', 'https://github.com/yawik/yavue-nuxt.git');

set('default_stage', 'prod');

// deploy to Hosts
host('nuxt.yawik.org')
    ->user('nuxt')
    ->stage('prod')
    ->multiplexing(false) 
    ->set('deploy_path', '/srv/production')
    ->set('writableusesudo', true);   
    
// if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// run npm 
after('deploy:symlink', 'npm');

// restart nodeserver
after('cleanup', 'restart');

task('npm', '
    npm i;
    npm run build;
    npm run generate;
');

task('restart', '
    systemctl restart nodeserver;
');