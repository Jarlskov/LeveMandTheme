<?php
    $cfs = CFS();
?>

<p>
    <?= $cfs->get('rating');?> ud af 6 ølglas.
</p>
<p>
    <a href="<?= $cfs->get('untappd_link')['url']; ?>" target="_blank">Untappd link</a>
</p>
