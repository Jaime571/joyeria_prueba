<?php
// Cargar phpdotenv manualmente (ajusta la ruta según tu estructura)
require __DIR__ . '/../../vendor/phpdotenv-master/src/Dotenv.php';
require __DIR__ . '/../../vendor/phpdotenv-master/src/Loader.php';
require __DIR__ . '/../../vendor/phpdotenv-master/src/Validator.php';

// Cargar las variables del archivo .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Configuración de la conexión a la base de datos (ahora desde .env)
$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];

try {
    // Crear una nueva instancia de conexión PDO
    $db = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);

    // Habilitar el manejo de errores de PDO
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Establecer el juego de caracteres a UTF-8
    $db->exec("SET NAMES 'utf8'");

    // Opcional: definir otras configuraciones de PDO si es necesario
} catch (PDOException $e) {
    // En caso de error, mostrar el mensaje de error
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
