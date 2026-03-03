<?php
try {
    $p = new PDO("mysql:host=localhost;dbname=ma_bdd;charset=utf8mb4", 'db_user', 'db_pwd');

    $p->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $p->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
    exit();
}

$migrationsFile = __DIR__ . "/migrations/migrations.json";
if (file_exists($migrationsFile)) {
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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>R6.06 Maintenance applicative</title>
    <style>
        <?php include_once 'css/style.css'; ?>
    </style>
</head>

<body>
    <header>
        <h1>R6.06 Maintenance applicative</h1>
        <h2 class="crismon">Evaluation</h2>
        <p class="crismon">Modifiez ce projet à l'aide des outils vus ensemble pour améliorer la maintenabilité
            de ce projet et déployez le sur le serveur mis à votre disposition</p>
        <p class="crismon">Vous êtes libre de modifier ce que vous souhaitez sur le projet, chaque amélioration
            (ou début d'amélioration) sera prise en compte dans la notation</p>
        <p id="invite" class="crismon">
            Pensez à inviter cdiiv sur votre projet Github</p>
    </header>

    <table>
        <thead>
            <tr>
                <td class="blackBorder">Id</td>
                <td class="blackBorder">Text</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;
            while (true) {
                if (!key_exists($i, $d))
                    break; ?>
                <tr>
                    <td class="blackBorder"><?= $d[$i]['id'] ?></td>
                    <td class="blackBorder"><?= $d[$i]['text'] ?></td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
</body>

</html>