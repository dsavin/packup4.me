<h1>Рюкзачек</h1>
<h2>С какой целью собирается?</h2>
<p>
    <?php echo $bag->getDescription(); ?>
</p>
<p>
    <?php echo link_to('Ссылка на рюкзак', '/' . $bag->getHash() ); ?>
</p>
<h2>В нем уже есть:</h2>
<ul>
<?php foreach($bag->getItems() as $i => $item): ?>
    <li>

        <?php echo $item->getName(); ?>
    </li>
<?php endforeach; ?>
</ul>
<h2>В нем ещё нет:</h2>
<ul>
    <?php foreach($free_items as $i => $item): ?>
        <li>
            <?php echo $item->getName(); ?>
        </li>
    <?php endforeach; ?>
</ul>
