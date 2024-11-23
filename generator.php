<?php

// Get module name and optional table schema from command line arguments
if ($argc < 2) {
    echo "Usage: php generate.php ModuleName [TableName:Column1:Type,Column2:Type,...]\n";
    exit(1);
}

$moduleName = ucfirst(preg_replace('/[^a-zA-Z0-9]/', '', $argv[1])); // Sanitize and capitalize
$tableSchema = isset($argv[2]) ? $argv[2] : null;

$basePath = __DIR__;

// Paths for the files to be created
$controllerPath = $basePath . DIRECTORY_SEPARATOR . "controllers" . DIRECTORY_SEPARATOR . "{$moduleName}Controller.php";
$modelPath = $basePath . DIRECTORY_SEPARATOR . "models" . DIRECTORY_SEPARATOR . "{$moduleName}Model.php";
$viewPath = $basePath . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . "index.php";
$jsPath = $basePath . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "js" . DIRECTORY_SEPARATOR . "{$moduleName}.js";
$cssPath = $basePath . DIRECTORY_SEPARATOR . "assets" . DIRECTORY_SEPARATOR . "css" . DIRECTORY_SEPARATOR . "{$moduleName}.css";
$sqlPath = $basePath . DIRECTORY_SEPARATOR . "sql" . DIRECTORY_SEPARATOR . "{$moduleName}.sql";

// Boilerplate templates
$controllerTemplate = <<<PHP
<?php

require_once './BaseController.php';

class {$moduleName}Controller extends BaseController {
    public function index() {
        \$this->addScript('/assets/js/{$moduleName}.js'); // Load JS
        \$this->addStyle('/assets/css/{$moduleName}.css'); // Load CSS
        \$this->loadView('{$moduleName}/index');
    }
}
PHP;

$modelTemplate = <<<PHP
<?php

class {$moduleName}Model {
    private \$table = '{$moduleName}';
    private \$conn;

    public function __construct(\$dbConnection) {
        \$this->conn = \$dbConnection;
    }

    // Example: Fetch all rows
    public function getAll() {
        \$sql = "SELECT * FROM {\$this->table}";
        \$stmt = \$this->conn->prepare(\$sql);
        \$stmt->execute();
        return \$stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
PHP;

$viewTemplate = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$moduleName} Module</title>
    <link rel="stylesheet" href="/assets/css/{$moduleName}.css">
</head>
<body>
    <h1>Welcome to the {$moduleName} Module</h1>
    <script src="/assets/js/{$moduleName}.js"></script>
</body>
</html>
HTML;

$jsTemplate = <<<JS
document.addEventListener('DOMContentLoaded', () => {
    console.log('{$moduleName} module loaded.');
    // Add your JavaScript logic here
});
JS;

$cssTemplate = <<<CSS
/* Styles for the {$moduleName} module */
body {
    font-family: Arial, sans-serif;
}

h1 {
    color: #007bff;
    text-align: center;
}
CSS;

// Handle database table schema (optional)
if ($tableSchema) {
    $tableName = strtolower($moduleName);
    $columns = [];
    $schemaParts = explode(',', $tableSchema);

    foreach ($schemaParts as $part) {
        if (strpos($part, ':') === false) {
            echo "Invalid schema format: $part. Use Column:Type format.\n";
            exit(1);
        }

        [$column, $type] = explode(':', $part);
        $columns[] = "`$column` $type";
    }

    $createTableSQL = "CREATE TABLE `$tableName` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        " . implode(",\n        ", $columns) . ",
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;";

    if (!is_dir("$basePath/sql")) {
        mkdir("$basePath/sql", 0777, true);
    }
    file_put_contents($sqlPath, $createTableSQL);
    echo "SQL file created at: {$sqlPath}\n";
}

// Create directories if they don't exist
if (!is_dir("$basePath/views/{$moduleName}")) {
    mkdir("$basePath/views/{$moduleName}", 0777, true);
    echo "Created view directory for {$moduleName}.\n";
}

if (!is_dir("$basePath/assets/js")) {
    mkdir("$basePath/assets/js", 0777, true);
}

if (!is_dir("$basePath/assets/css")) {
    mkdir("$basePath/assets/css", 0777, true);
}

// Create the files with the templates
file_put_contents($controllerPath, $controllerTemplate);
echo "Controller created at: {$controllerPath}\n";

file_put_contents($modelPath, $modelTemplate);
echo "Model created at: {$modelPath}\n";

file_put_contents($viewPath, $viewTemplate);
echo "View created at: {$viewPath}\n";

file_put_contents($jsPath, $jsTemplate);
echo "JavaScript file created at: {$jsPath}\n";

file_put_contents($cssPath, $cssTemplate);
echo "CSS file created at: {$cssPath}\n";

// Final output message
echo "Module '{$moduleName}' generated successfully!\n";
