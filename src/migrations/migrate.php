<?php

$migrationsFile = __DIR__ . "/migrations/migrations.json";
if (file_exists($migrationsFile)) {

    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=mydb;charset=utf8mb4", 'db_user', 'db_pwd');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
        exit();
    }

    $migrations = json_decode(file_get_contents($migrationsFile), true);

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id INTEGER PRIMARY KEY,
            executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    $executedMigrations = $pdo->query("SELECT id FROM migrations")->fetchAll(PDO::FETCH_COLUMN);

    foreach ($migrations as $migration) {
        if (!in_array($migration["id"], $executedMigrations)) {
            $params = [];
            foreach (get_object_vars($migration) as $key => $value) {
                $params[":" . $key] = $value;
            }
            $pdo->prepare($migration["script"])->execute($params);
            $pdo->prepare("INSERT INTO migrations (id) VALUES (:id)")->execute([":id" => $migration["id"]]);
        }
    }
}
