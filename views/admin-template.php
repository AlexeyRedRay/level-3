<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>admin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="library Sh++">
    <link rel="stylesheet" href="http://lvl3.loc/assets/style/libs.min.css">
    <link rel="stylesheet" href="http://lvl3.loc/assets/style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

<section id="header" class="header-wrapper">
    <nav class="navbar navbar-default">
        <div class="logo">
            <a href="http://lvl3.loc/" class="navbar-brand"><span class="sh">Ш</span><span class="plus">++</span></a>
        </div>
        <div>
            <h3>Admin</h3>
            <button style="text-decoration: none; color: #f7f7f7; font-size: 18px; font-weight: 600; background-color: #2e2e2e">
                <a href="http://login:0@lvl3.loc/admin/logout">Exit &#128682;</a></button>
        </div>
    </nav>
</section>

<div class="container" style="padding-top: 20px;">

    <div class="row">

        <div class="col d-flex flex-column">

            <table class="table flex-grow-1">
                <thead>
                <tr>
                    <th scope="col">title of the book</th>
                    <th scope="col">authors</th>
                    <th scope="col">year of publication</th>
                    <th scope="col">delete</th>
                    <th scope="col">number of clicks</th>
                </tr>
                </thead>
                <tbody>

                <?php if ($content) : ?>
                <?php foreach($content as $item) :
                    $title = htmlspecialchars( $item['title'], ENT_QUOTES);
                    $author = htmlspecialchars( $item['author'], ENT_QUOTES);
                    $year = htmlspecialchars( $item['year'], ENT_QUOTES);
                    $clicks = htmlspecialchars( $item['clicks'], ENT_QUOTES);
                    ?>
                    <tr>
                        <td><?= $title ?></td>
                        <td><?= $author ?></td>
                        <td><?= $year ?></td>
                        <td><a class="page-link" href="http://lvl3.loc/admin/?delete=<?= $item['book_id'] ?>">delete</a></td>
                        <td><?= $clicks ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>

            <?php if ($content) : ?>
            <?php if (array_key_exists('admin_page', $content[0])) : ?>
                <div class="row flex-shrink-1">
                    <div class="col">
                        <nav class="justify-content-center">
                            <ul class="pagination justify-content-center">
                                <?php for ($i = 1; $i <= $content[0]['admin_count_pages']; $i++) : ?>
                                    <li class="page-item"><a class="page-link" href="http://lvl3.loc/admin/?table-page=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>

        <div class="col">
            <form class="row" style="border: 2px solid #0b0b0b; padding: 10px " name="add-book" action="admin" method="post" enctype="multipart/form-data">
                <div class="col">
                    <input class="mb-3" name="title" type="text" placeholder="title of the book" required> <br>
                    <input class="mb-3" name="year" type="text" placeholder="year of publication" required> <br>
                    <input class="mb-3" name="pages" type="text" placeholder="number of pages" required> <br>
                    <input class="mb-3" name="isbn" type="text" placeholder="isbn" required> <br>
                    <input name="image" type="file"> <br>
                </div>
                <div class="col">
                    <input class="mb-3" name="author1" type="text" placeholder="author 1" required> <br>
                    <input class="mb-3" name="author2" type="text" placeholder="author 2"> <br>
                    <input class="mb-3" name="author3" type="text" placeholder="author 3"> <br>
                    <textarea name="description" cols="30" rows="10" required></textarea> <br>
                </div>
                <button type="submit" class="btn btn-success" style="display: block; width: 100px;" >Success</button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>