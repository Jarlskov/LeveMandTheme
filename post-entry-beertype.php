<?php
    $cfs = CFS();

    $reviewsTitle = 'Anmeldte ' . get_the_title() . 's';
    if ($cfs->get('reviews_title')) {
        $reviewsTitle = $cfs->get('reviews_title');
    }

    $reviews = array();

    $id = get_the_ID();
    $options = array(
        'post_type' => 'beer',
        'field_name' => 'beer_type',
    );

    $reviewIds = $cfs->get_reverse_related($id, $options);
    foreach ($reviewIds as $reviewId) {
        $url = get_the_permalink($reviewId);
        $title = get_the_title($reviewId);

        $reviews[] = "<a href='$url'>$title</a>";
    }
?>

<?php if (!empty($cfs->get('references'))): ?>
    <p>
        <h2>Referencer og mere info</h2>
        <?php foreach ($cfs->get('references') as $reference): ?>
            <?= $reference['reference']; ?><br>
        <?php endforeach; ?>
    </p>
<?php endif; ?>

<?php if (!empty($cfs->get('related_types'))): ?>
    <p>
        <h2>Relaterede typer</h2>
        <?php foreach ($cfs->get('related_types') as $relation): ?>
            <?php $relatedId = current($relation['related_type']); ?>
            <a href="<?= get_the_permalink($relatedId); ?>"><?= get_the_title($relatedId); ?></a>
            <?= isset($relation['relationship_notes']) ? $relation['relationship_notes'] : ''; ?>
            <br>
        <?php endforeach; ?>
    </p>
<?php endif; ?>

<?php if (!empty($reviews)): ?>
    <h2><?= $reviewsTitle; ?></h2>
    <p>
        <?php foreach ($reviews as $review):?>
            <?= $review;?><br>
        <?php endforeach; ?>
    </p>
<?php endif; ?>
