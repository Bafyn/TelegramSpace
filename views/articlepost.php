<div class="wrapper">
    <div class="post-vnut">
        <h3><?= $data['title'] ?>
            <span class="data-post-2"><i><img src="/template/img/icon/i-4.png"
                                              alt=""></i><?= $data['pub_date'] ?></span>
        </h3>
        <?= $data['content'] ?>
    </div>
    <a href="/article/list" class="go-to-articles">
        Список статей
    </a>
</div>
