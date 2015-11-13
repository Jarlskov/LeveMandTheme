<?php
    $cfs = CFS();
    
    $fields = array(
        'homepage'      => 'Hjemmeside',
        'facebook_page' => 'Facebook',
        'untappd_page'  => 'Untappd',
    );

    $has_content = false;
    foreach ($fields as $field => $name) {
        $has_content = $has_content || $cfs->get($field);
    }
?>

<?php if ($has_content): ?>
    <p>
        <?php foreach ($fields as $field => $name): ?>
            <?php if ($cfs->get($field)): ?>
                <b><?= $name;?>:</b> <?= $cfs->get($field); ?><br>
            <?php endif; ?>
        <?php endforeach; ?>
    </p>
<?php endif; ?>
