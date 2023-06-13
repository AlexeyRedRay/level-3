<?php extract($content); ?>
<div id="content" class="book_block col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <script id="pattern" type="text/template">
        <div data-book-id="{id}" class="book_item col-xs-6 col-sm-3 col-md-2 col-lg-2">
            <div class="book">
                <a href="/book/{id}"><img src="img/books/{id}.jpg" alt="{title}">
                    <div data-title="{title}" class="blockI">
                        <div data-book-title="{title}" class="title size_text">{title}</div>
                        <div data-book-author="{author}" class="author">{author}</div>
                    </div>
                </a>
                <a href="/book/{id}">
                    <button type="button" class="details btn btn-success">Читать</button>
                </a>
            </div>
        </div>
    </script>
    <div id="id" book-id="<?= htmlspecialchars($id, ENT_QUOTES); ?>">
        <div id="bookImg" class="col-xs-12 col-sm-3 col-md-3 item">
            <img src="http://lvl3.loc/assets/img/<?= $id ?>.jpg" alt="Responsive image" class="img-responsive">

            <hr>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9 info">
            <div class="bookInfo col-md-12">
                <div id="title" class="titleBook"><?= htmlspecialchars($title, ENT_QUOTES); ?></div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="bookLastInfo">
                    <?php if(empty($author2)) : ?>
                        <div class="bookRow"><span class="properties">автор:</span><span id="author"><?= htmlspecialchars( $author, ENT_QUOTES); ?></span></div>
                    <?php else : ?>
                        <div class="bookRow"><span class="properties">авторы:</span><span id="author"><?php
                                echo htmlspecialchars( $author, ENT_QUOTES);
                                if (!empty($author2)) {
                                    echo " ," . htmlspecialchars( $author2, ENT_QUOTES);
                                }
                                if (!empty($author3)) {
                                    echo " ," . htmlspecialchars( $author3, ENT_QUOTES);
                                }
                                ?></span></div>
                    <?php endif; ?>
                    <div class="bookRow"><span class="properties">год:</span><span id="year"><?= htmlspecialchars( $year, ENT_QUOTES); ?></span></div>
                    <div class="bookRow"><span class="properties">страниц:</span><span id="pages"><?= htmlspecialchars( $pages, ENT_QUOTES); ?></span></div>
                    <div class="bookRow"><span class="properties">isbn:</span><span id="isbn"><?= htmlspecialchars( $isbn, ENT_QUOTES); ?></span></div>
                </div>
            </div>
            <div class="btnBlock col-xs-12 col-sm-12 col-md-12">
                <button type="button" class="btnBookID btn-lg btn btn-success">Хочу читать!</button>
            </div>
            <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-xs hidden-sm">
                <h4>О книге</h4>
                <hr>
                <p id="description"><?= htmlspecialchars( $description, ENT_QUOTES); ?></p>
            </div>
        </div>
        <div class="bookDescription col-xs-12 col-sm-12 col-md-12 hidden-md hidden-lg">
            <h4>О книге</h4>
            <hr>
            <p class="description"><?= htmlspecialchars( $description, ENT_QUOTES); ?></p>
        </div>
    </div>
    <script src="http://lvl3.loc/assets/js/book.js" defer=""></script>
</div>