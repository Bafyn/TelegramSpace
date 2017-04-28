<i class="fa fa-cogs image_elem part_97"
   style="position:relative; top: 23px; left: 70px;" aria-hidden="true"></i>
<div class="slider-block-post"
     style="background-image: url('<?= $data['part_97']['code'] ?>')">
    <div class="wrapper">
        <div class="slider-post">
            <h3>
                <i><img src="/template/img/icon/i-1.png" alt=""></i>
                <i class="fa fa-cogs text_elem part_98" aria-hidden="true"></i>
                <span class="part_98"><?= $data['part_98']['code'] ?></span>
            </h3>
            <p>
                <i class="fa fa-cogs text_elem part_99"
                   aria-hidden="true"></i>
                <span class="part_99"><?= $data['part_99']['code'] ?></span>
            </p>
        </div>
    </div>
</div>
<div class="wrapper">
    <div class="content-post-vn">
        <h3>
            <i class="fa fa-cogs text_elem part_100" aria-hidden="true"></i>
            <span class="line-title-2"></span><span class="part_100"><?= $data['part_100']['code'] ?></span>
        </h3>

        <?php foreach ($data['articles'] as $article): ?>
            <div class="segment-post">
                <h4><?= $article['title'] ?>
                    <span class="data-post">
                        <i><img src="/template/img/icon/i-4.png" alt=""></i>
                        <?= $article['pub_date'] ?>
                    </span>
                </h4>
                <div class="img-post-block">
                    <img src="/template/img/articles/<?= $article['image'] ?>" alt="">
                    <a href="/article?post=<?= $article['id'] ?>">
                        Читать полностью
                    </a>
                </div>
                <div class="text-prev-post">
                    <?= mb_substr(html_entity_decode(strip_tags($article['content']), ENT_QUOTES | ENT_HTML401), 0, 550) . '...' ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach; ?>

        <!--        <a href="#" class="btn-post-full"><i><img src="/template/img/elements/plus.png" alt=""></i>Читать остальное</a>-->
    </div>
</div>