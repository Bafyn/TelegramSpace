<div class="slider-block-sticer"
     style="background-image: url('<?= $data['part_88']['code'] ?>')">
    <i class="fa fa-cogs image_elem part_88"
       style="position:relative; left: 70px;"
       aria-hidden="true"></i>
    <div class="wrapper">
        <div class="slider-manual">
            <h3>
                <i><img src="/template/img/icon/i-1.png" alt=""></i><br>
                <i class="fa fa-cogs text_elem part_89"
                   aria-hidden="true"></i>
                <span class="part_89"><?= $data['part_89']['code'] ?></span>
            </h3>
            <p>
                <i class="fa fa-cogs text_elem part_90"
                   aria-hidden="true"></i>
                <span class="part_90"><?= $data['part_90']['code'] ?></span>
            </p>
        </div>
    </div>
</div>
<div class="content-stiker">
    <div class="wrapper">
        <h3>
            <i class="fa fa-cogs text_elem part_91"
               aria-hidden="true"></i>
            <span class="part_91"><?= $data['part_91']['code'] ?></span>
        </h3>
        <p>
            <i class="fa fa-cogs text_elem part_92"
               aria-hidden="true"></i>
            <span class="part_92"><?= $data['part_92']['code'] ?></span>
        </p>

        <?php
        $num_of_stickers = count($data['stickers']);
        foreach ($data['stickers'] as $sticker): ?>
            <div class="segment-sticer">
                <div>
                    <h4><?= $sticker['title'] ?></h4>
                    <img class="id-phone-stick" src="/template/img/stickers/<?= $sticker['image'] ?>" alt="">
                    <p>
                        <?= $sticker['description'] ?>
                    </p>
                </div>
                <div class="sticer-img">
                    <img src="/template/img/stickers/<?= $sticker['image'] ?>" alt="">
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach;
        if ($num_of_stickers == 0) { ?>
            <div class="block-catalog">
                <h3>
                    Стикеры временно отсутствуют<br>
                </h3>
            </div>
            <?php
        } ?>

        <div class="bottom-info-sticer">
            <p>
                <i class="fa fa-cogs text_elem part_93"
                   aria-hidden="true"></i>
                <span class="part_93"><?= $data['part_93']['code'] ?></span>
            </p>
            <a href="/sticker/manual" class="link-stick">
                создать стикер
            </a>
        </div>
    </div>
</div>