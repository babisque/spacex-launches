    <p>Voo numero: <?= $flightNumber; ?></p>
    <p>Detalhes: <?= $details ?></p>

    <?php foreach ($rocketDetails as $rocketDetail): ?>
        <img src="<?= $rocketDetail; ?>" alt="">
    <?php endforeach; ?>

