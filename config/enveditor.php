<?php

return [
    // EnvEditor must write backups to a writable path in containers.
    'pathToEnv'       => base_path('.env'),
    'backupPath'      => storage_path('app/dotenv-editor/'),
    'filePermissions' => env('FILE_PERMISSIONS', 0755),
];
