<?php

declare(strict_types=1);

// report all errors
error_reporting(-1);

// require composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// create php web server for local resources
call_user_func(function (): void {
    // Command that starts the built-in web server
    $command = sprintf(
        'php -S %s:%d -t %s > /dev/null 2>&1 & echo $!',
        '127.0.0.1',
        '8999',
        escapeshellarg(__DIR__ . '/_files/public/'),
    );

    // Execute the command and store the process ID
    $output = [];
    exec($command, $output);
    if (! isset($output[0])) {
        trigger_error('Unable to start server using ' . $command, E_USER_ERROR);
    }
    $pid = (int) $output[0];

    // Kill the web server when the process ends
    /** @var callable(): void $shutdownKillPid */
    $shutdownKillPid = function () use ($pid): void {
        exec('kill ' . $pid);
    };
    register_shutdown_function($shutdownKillPid);

    // wait until server is responding
    do {
        usleep(10000); // wait 0.01 seconds before each try
        $headers = @get_headers('http://localhost:8999/README.md') ?: [];
        $httpResponse = strval($headers[0] ?? '');
    } while (! str_contains($httpResponse, '200 OK'));
});
