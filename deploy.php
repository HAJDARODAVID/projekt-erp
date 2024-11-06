<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/HAJDARODAVID/projekt-erp.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('64.225.101.184')
    ->set('remote_user', 'root')
    ->set('deploy_path', 'var/www/hidro-projekt');

after('deploy:failed', 'deploy:unlock');
