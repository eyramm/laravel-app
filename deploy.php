<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'blog');

// Project repository
set('repository', 'git@github.com:eyramm/laravel-app.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('206.189.123.203')
    ->user('deployer')
    ->set('deploy_path', '/var/www/html/blog')    
    ->identityFile('~/.ssh/deployerkey');    

    // Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

