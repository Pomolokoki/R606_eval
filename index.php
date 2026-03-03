<?php
    include_once("migrations/migrate.php");
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