<h1>Рюкзачек</h1>
<h2>С какой целью собирается?</h2>
<?php echo $bag->getDescription(); ?>
<h2>В нем уже есть:</h2>
<ul>
<?php foreach($bag->getItems() as $i => $item): ?>
    <li>

        <?php echo $item->getName(); ?>
    </li>
<?php endforeach; ?>
</ul>
<h2>В нем уже есть2:</h2>
<ul>
    <?php foreach($free_items as $i => $item): ?>
        <li>

            <?php echo $item->getName(); ?>
        </li>
    <?php endforeach; ?>
</ul>
