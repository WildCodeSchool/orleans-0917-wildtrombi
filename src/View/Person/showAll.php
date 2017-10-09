<ul>
    <?php foreach ($persons as $person) : ?>
        <li><?= $person->getFirstname() . ' ' . $person->getLastname() ?></li>
    <?php endforeach; ?>
</ul>