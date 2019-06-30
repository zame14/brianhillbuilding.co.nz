<?php
$project = new Project($post);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
        <div class="row">
            <div class="col-12 page-title-wrapper">
                <h1 class="page-title"><?=$project->getTitle()?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-7">
                <div class="gallery">
                    <?=$project->displayGallery()?>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-5">
                <div class="description">
                    <?=$project->getContent()?>
                </div>
            </div>
        </div>
        <div class="row project-navigation">
            <div class="col-12">
                <ul>
                    <?php
                    $previous = $project->previous();
                    $next = $project->next();
                    ?>
                    <li><a href="<?=$previous->link()?>">Previous project</a></li>
                    <li><a href="<?=$next->link()?>">Next project</a></li>
                </ul>
            </div>
        </div>
    </div>
</article>
