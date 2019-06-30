<?php
$service = new Service($post);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 page-title-wrapper">
                <h1 class="page-title"><?=$service->getTitle()?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <h2><?=$service->getSnippet()?></h2>
            </div>
            <div class="col-12 col-sm-6">
                <?php
                $imageid = getImageID($service->getFeatureImage());
                $img = wp_get_attachment_image_src($imageid, 'feature');
                ?>
                <div class="image-wrapper">
                    <img src="<?=$img[0]?>" alt="<?=$service->getTitle()?>" />
                </div>
            </div>
            <div class="col-12">
                <div class="description">
                    <?=$service->getContent()?>
                </div>
                <div class="btn-wrapper">
                    <a href="<?=get_page_link(18)?>" class="btn btn-primary">contact us</a>
                </div>
            </div>
        </div>
    </div>
</article>
