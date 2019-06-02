<?php
if (is_file(__DIR__ . '.env')) {
    die('error:' . PHP_EOL);
}
exec("cd LaravelPlus");
$basename = basename(__DIR__);
if ('LaravelPlus' !== $basename) {
    echo 'error: 错误原始项目路径' . $basename . PHP_EOL;
    die;
}
if ($argv && isset($argv[1])) {
    $product = $argv[1];
} else {
    echo 'error: 未设置项目名' . PHP_EOL;
    echo 'eg): php LaravelPlus/copy.php YourProject' . PHP_EOL;
    die;
}
if (is_file('LaravelPlus/composer.lock')) {
    exec("rm LaravelPlus/composer.lock");
}
if (is_file('LaravelPlus/.travis')) {
    exec("rm LaravelPlus/.travis");
}
if (is_file('LaravelPlus/_config.yml')) {
    exec("rm LaravelPlus/_config.yml");
}
if (is_dir('LaravelPlus/vendor')) {
    exec("rm -rf LaravelPlus/vendor/*");
}
if (is_dir('LaravelPlus/.github')) {
    exec("rm -rf LaravelPlus/.github/*");
}
exec("cp -r LaravelPlus/* {$product}");
if (is_file("{$product}/copy.php")) {
    exec("rm {$product}/copy.php");
}
$hidden_files = [
    '.env.example',
    '.gitattributes',
    '.gitignore',
];
foreach ($hidden_files as $hidden_file) {
    exec("cp LaravelPlus/{$hidden_file} {$product}/{$hidden_file}");
}
exec("cp {$product}/.env.example {$product}/.env");
exec("cd {$product}");
echo 'success' . PHP_EOL;
