<?php
    include_once "migrations/migrate.php" ;

    try {
        $pdo = new PDO("mysql:host=localhost;port=3306;dbname=mydb;charset=utf8mb4", 'db_user', 'db_pwd');

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
        exit();
    }
    $data = $pdo->query('SELECT id,text FROM random_text_table')->fetchAll(PDO::FETCH_ASSOC);
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
                if (!key_exists($i, $data))
                    break; ?>
                <tr>
                    <td class="blackBorder"><?= $data[$i]['id'] ?></td>
                    <td class="blackBorder"><?= $data[$i]['text'] ?></td>
                </tr>
                <?php $i++;
            } ?>
        </tbody>
    </table>
</body>

</html>
