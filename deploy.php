<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'dep');

// Project repository
set('repository', 'git@github.com:HAJDARODAVID/projekt-erp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', [
    'storage',
    'bootstrap',
]);

// Hosts
host('HP_Q-sys')
    ->setHostname('64.225.101.184')
    ->setRemoteUser('deploy')
    ->setIdentityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/hidro-projekt-test')
    ->set('branch', 'master')
    ->set('ssh_multiplexing', true);

host('HP_P-sys')
    ->setHostname('64.225.101.184')
    ->setRemoteUser('deploy')
    ->setIdentityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/hidro-projekt')
    ->set('branch', 'master')
    ->set('ssh_multiplexing', true);

// Custom task to check condition and run migration
task('deploy:conditionally_migrate', function () {
    // Define your condition here
    $shouldMigrate = false; // Replace with your actual condition

    if ($shouldMigrate) {
        invoke('artisan:migrate');
    } else {
        writeln('Skipping migration as the condition is not met.');
    }
});
// Tasks
task('build', function () {
    run('cd {{release_path}} && build');
});


desc('Custom Composer install');
task('deploy:vendors', function () {
    writeln('Running custom Composer install...');
    if (!commandExist('unzip')) {
        warning('To speed up composer installation, setup "unzip" command with PHP zip extension.');
    }
    run('
        cd {{release_or_current_path}} && 
        {{bin/composer}} install --ignore-platform-req=ext-zip && 
        npm install &&
        rm -rf package-lock.json node_modules &&
        npm cache clean --force #use --force &&
        npm i && npm run build');
});

// Hook the custom deploy:vendors task
//after('deploy:update_code', 'deploy:vendors');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'deploy:conditionally_migrate');
