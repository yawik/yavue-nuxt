<?php
namespace Deployer;

require 'recipe/zend_framework.php';


// Project name
set('application', 'YAWIK-nuxt');

// Project repository
set('repository', 'git@github.com:yawik/yavue-nuxt.git');

// Shared files/dirs between deploys 
#add('shared_files', [
#    'test/sandbox/public/.htaccess',
#    'test/sandbox/public/robots.txt',
#]);

#add('shared_dirs', [
#    'test/sandbox/var/log',
#    'test/sandbox/var/cache',
#    'test/sandbox/config/autoload',
#    'test/sandbox/public/static',	// used by eg. organization logos
#]);

// Writable dirs by web server 
#add('writable_dirs', [
#    'test/sandbox/var/cache',
#    'test/sandbox/var/log',
#    'test/sandbox/public/static',
#]);

set('default_stage', 'prod');

// Hosts

host('nuxt.yawik.org')
    ->user('nuxt')
    ->stage('prod')
    ->multiplexing(false) 
    ->set('deploy_path', '/srv/production')
    ->set('writableusesudo', true);   
    
// [Optional] if deploy fails automatically unlock.
#after('deploy:failed', 'deploy:unlock');

task('pwd', function () {
    $result = run('pwd');
    writeln("Current dir: $result");
});