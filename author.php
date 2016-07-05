<?php
    get_header();
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
?>

<article class="entry">
    <div class="entry-inner">
        <header class="entry-header">
            <h1 class="entry-title">
                <?= $curauth->display_name; ?>
            </h1>
        </header>
        <div class="entry-content">
            <figure style="width: 180px;" class="wp-caption alignright">
                <?= get_avatar($curauth->id, 180, '', '$curauth->display_name');?>
            </figure>
            <p>
                <?php if (!empty($curauth->user_url)): ?>
                    <b>Hjemmeside:</b> <a href="<?= $curauth->user_url; ?>"><?= $curauth->user_url; ?></a><br>
                <?php endif; ?>
                <?php if (!empty($curauth->facebook)): ?>
                    <b>Facebook:</b> <a href="http://facebook.com/<?= $curauth->facebook; ?>"><?= $curauth->facebook; ?></a><br>
                <?php endif; ?>
                <?php if (!empty($curauth->twitter)): ?>
                    <b>Twitter:</b> <a href="http://twitter.com/<?= $curauth->twitter; ?>">@<?= $curauth->twitter; ?></a><br>
                <?php endif; ?>
                <?php if (!empty($curauth->googleplus)): ?>
                    <b>Google+:</b> <a href="http://plus.google.com/+<?= $curauth->googleplus; ?>"><?= $curauth->googleplus; ?></a><br>
                <?php endif; ?>
            </p>
            <p>
                <h2>Biografi</h2>
                <?= nl2br($curauth->description); ?>
            </p>
        </div>
<?php
?>
    </div>
</article>

<?php
    get_footer();
?>
