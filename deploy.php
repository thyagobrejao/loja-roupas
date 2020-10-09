<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'semprelinda');

// Project repository
set('repository', 'git@github.com:thyagobrejao/loja-roupas.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', ['.env']);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('production')
    ->hostname('app1.do')
    ->set('deploy_path', '~/{{application}}')
    ->user('www-data');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

task('reload:php-fpm', function () {
    run('sudo /bin/systemctl restart php7.4-fpm');
});

after('deploy', 'reload:php-fpm');
