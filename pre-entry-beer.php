<?php
    $cfs = CFS();

    $breweries = array();
    if ($cfs->get('brewery')) {
        foreach ($cfs->get('brewery') as $brewery) {
            $url = get_permalink($brewery);
            $title = get_the_title($brewery);
            $breweries[] = "<a href='$url'>$title</a>";
        }
    }
    if ($cfs->get('brewery_name')) {
        $breweries[] = $cfs->get('brewery_name');
    }

    $beerType = '';
    if ($cfs->get('beer_type')) {
        $type = current($cfs->get('beer_type'));
        $url = get_permalink($type);
        $title = get_the_title($type);
        $beerType = "<a href='$url'>$title</a>";
    }
    else {
        $beerType = $cfs->get('beer_type_name');
    }

    $brewedAt = '';
    if ($cfs->get('brewed_at')) {
        $bat = current($cfs->get('brewed_at'));
        $url = get_permalink($bat);
        $title = get_the_title($bat);
        $brewedAt = "<a href='$url'>$title</a>";
    }
    else {
        $brewedAt = $cfs->get('brewed_at_name');
    }
?>

<p>
    <?php if (!empty($breweries)): ?>
        <b>Bryggeri:</b> <?= implode(' / ', $breweries);?><br>
    <?php endif; ?>
    <?php if (!empty($brewedAt)): ?>
        <b>Brygget hos:</b> <?= $brewedAt; ?><br>
    <?php endif; ?>
    <?php if (!empty($beerType)): ?>
        <b>Type:</b> <?= $beerType; ?><br>
    <?php endif; ?>
    <?php if (!empty($cfs->get('country'))): ?>
        <b>Land:</b> <?= $cfs->get('country'); ?><br>
    <?php endif;?>
    <?php if (!empty($cfs->get('alcohol'))): ?>
        <b>Alkoholstyrke:</b> <?= $cfs->get('alcohol'); ?>%<br>
    <?php endif; ?>
    <?php if ($cfs->get('ibu')): ?>
        <b>IBU:</b> <?= $cfs->get('ibu'); ?><br>
    <?php endif; ?>
</p>
