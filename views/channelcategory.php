<div class="slider-canal-slider">
    <h3>
        <i><img src="/template/img/icon/i-1.png" alt=""></i><br>
        Каналы категории "<?= $data['current_category']['title'] ?>"
    </h3>
</div>
<div class="content-canal-category">
    <div class="wrapper">

        <?php if ($data['is_valid_category']) {
            $num_of_channels = count($data['category_channels']);
            foreach ($data['category_channels'] as $channel): ?>
                <div class="segment-category-canal">
                    <a href="<?= $channel['link'] ?>" target="_blank" class="add-canal-cat"></a>
                    <div class="title-category">
                        <div class="ava-category">
                            <img src="/template/img/channels/<?= $channel['image'] ?>" alt="">
                        </div>
                        <div class="title-text-category">
                            <h4>
                                <?= $channel['title'] ?>
                            </h4>
                            <span class="col-look">
                        < <?= $channel['members'] ?>
                    </span>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="desc-category">
                        <p>
                            <?= $channel['description'] ?>
                        </p>
                    </div>
                </div>
            <?php endforeach;
            if ($num_of_channels == 0) { ?>
                <div class="block-catalog">
                    <h3>
                        В этой категории каналы отсутствуют. <br/>Предложите свой на странице категорий!
                    </h3>
                </div>
                <a href="/channel/categories" class="link-stick" style="margin-bottom: 70px;">
                    Каталог каналов
                </a>
            <?php }
        } ?>

        <div class="clear"></div>
    </div>
</div>