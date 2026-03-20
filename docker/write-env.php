<?php
/**
 * Writes /app/.env from container environment variables.
 * Called by docker/startup.sh on every container start.
 * Using PHP ensures special characters in values are handled safely.
 */

$keys = [
    'APP_NAME', 'APP_ENV', 'APP_KEY', 'APP_DEBUG', 'APP_URL',
    'LOG_CHANNEL', 'LOG_LEVEL',
    'DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD',
    'CACHE_DRIVER', 'CACHE_STORE', 'SESSION_DRIVER', 'QUEUE_CONNECTION',
    'TIMEZONE',
    'MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD',
    'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS', 'MAIL_FROM_NAME', 'MAIL_EHLO_DOMAIN',
    'DEMO', 'MIX_API_KEY', 'VITE_API_KEY',
    'CURRENCY', 'CURRENCY_SYMBOL', 'CURRENCY_POSITION', 'CURRENCY_DECIMAL_POINT',
    'DATE_FORMAT', 'TIME_FORMAT',
];

$defaults = [
    'APP_ENV'              => 'production',
    'APP_DEBUG'            => 'false',
    'LOG_CHANNEL'          => 'stack',
    'LOG_LEVEL'            => 'warning',
    'DB_CONNECTION'        => 'mysql',
    'DB_HOST'              => 'db',
    'DB_PORT'              => '3306',
    'CACHE_DRIVER'         => 'file',
    'CACHE_STORE'          => 'file',
    'SESSION_DRIVER'       => 'file',
    'QUEUE_CONNECTION'     => 'sync',
    'TIMEZONE'             => 'UTC',
    'MAIL_MAILER'          => 'smtp',
    'MAIL_PORT'            => '587',
    'MAIL_ENCRYPTION'      => 'tls',
    'DEMO'                 => 'false',
    'CURRENCY'             => 'USD',
    'CURRENCY_SYMBOL'      => '$',
    'CURRENCY_POSITION'    => '5',
    'CURRENCY_DECIMAL_POINT' => '2',
    'DATE_FORMAT'          => 'd-m-Y',
    'TIME_FORMAT'          => 'h:i A',
];

$lines = [];
foreach ($keys as $key) {
    $value = getenv($key);
    if ($value === false || $value === '') {
        $value = $defaults[$key] ?? '';
    }
    // Wrap in double-quotes to safely handle spaces, $, #, and other special chars.
    // Escape any existing backslashes and double-quotes inside the value.
    $escaped = str_replace(['\\', '"'], ['\\\\', '\\"'], $value);
    $lines[] = $key . '="' . $escaped . '"';
}

$content = implode(PHP_EOL, $lines) . PHP_EOL;

if (file_put_contents('/app/.env', $content) === false) {
    fwrite(STDERR, "[write-env] ERROR: could not write /app/.env\n");
    exit(1);
}

@chown('/app/.env', 'application');
@chmod('/app/.env', 0640);

echo '[write-env] Written ' . count($lines) . " variables to /app/.env\n";
