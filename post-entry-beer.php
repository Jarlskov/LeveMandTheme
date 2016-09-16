<?php
    $cfs = CFS();
?>

<p>
    <?php if (!empty($cfs->get('rating'))): ?>
        <?= $cfs->get('rating');?> ud af 6 ølglas.
    <?php endif; ?>
</p>
<p>
    <a href="<?= $cfs->get('untappd_link')['url']; ?>" target="_blank">Untappd link</a>
</p>
