<?php

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function test_db_can_be_accessed(): void
    {
        $pdo = new PDO("mysql:host=localhost;dbname=ma_bdd;charset=utf8mb4", 'db_user', 'db_pwd');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        echo "Connexion OK à MySQL.\n";

        $ok = $pdo->exec("
                CREATE TABLE IF NOT EXISTS migrations (
                    id INTEGER PRIMARY KEY,
                    executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )
            ");

        $this->assertTrue($ok);

    }
}
