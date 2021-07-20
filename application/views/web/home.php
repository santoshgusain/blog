<div class="container my-4">

    <?php foreach($posts as $post ){?>
    <div class="card">
        <div class="card-header">
        <h5 style="font-weight: bold;">
            <?= ucwords($post->vTitle)?>
        </h5>
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <?= $post->tContent?>
                <footer class="blockquote-footer">Post By <cite title="Source Title"><?= ucwords($post->author)?></cite></footer>
            </blockquote>
        </div>
    </div>
    <?php }?>

</div>