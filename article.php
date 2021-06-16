<?php
	include 'media/includes/config.php';
	/**
	 * @var string $connection
	 * @var string $config
	 * @var string $categories
	 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config['title']; ?></title>

    <!-- Bootstrap Grid -->
    <link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Custom -->
    <link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

<div id="wrapper">

	<?php include "media/includes/header.php";
		$article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['category']);
		if (mysqli_num_rows($article) <= 0) {
	?>
    <div id="content">
        <div class="container">
            <div class="row">
                <section class="content__left col-md-8">
                    <div class="block">
                        <h2>Статья не найдена!</h2>
                        <div class="block__content">
                            <img src="https://image.flaticon.com/icons/png/512/564/564813.png" alt="Article_Not_Found">

                            <div class="full-text">
                                Запрашиваемая Вами статья не существует.
                            </div>
                        </div>
                    </div>
									<?php } else{
										$art = mysqli_fetch_assoc($article);
										mysqli_query($connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int)$art['id'])
									?>
                    <div id="content">
                        <div class="container">
                            <div class="row">
                                <section class="content__left col-md-8">
                                    <div class="block">
                                        <a><?php echo $art['views']; ?></a>
                                        <h2><?php echo $art['title']; ?></h2>
                                        <div class="block__content">
                                            <img src="/media/static/images/<?php echo $art['image']; ?>"
                                                 alt="test_image">

                                            <div class="full-text"><?php echo $art['text']; ?>
                                            </div>
                                        </div>
                                    </div>
																	<?php } ?>
                                    <div class="block">
                                        <a href="#comment-add-form">Добавить свой</a>
                                        <h3>Комментарии к статье</h3>
                                        <div class="block__content">
                                            <div class="articles articles__vertical">
																							<?php
																								$comments = mysqli_query($connection, "SELECT * FROM `comments` WHERE `article_id`= " . (int)$art['id'] . " ORDER BY `id` DESC");
																								if (mysqli_num_rows($comments) <= 0) {
																									echo "К данной статье еще никто не написал комментарий, будьте первым.";
																								}
																								while ($comment = mysqli_fetch_assoc($comments)) {
																									?>
                                                    <article class="article">
                                                        <div class="article__image"
                                                             style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($comment['email']); ?>?s=125)"></div>
                                                        <div class="article__info">
                                                            <a href="/article.php?category=<?php echo $comment['article_id']; ?>"><?php echo $comment['author']; ?></a>
                                                            <div class="article__info__meta"></div>
                                                            <div class=" article__info__preview"><?php echo $comment['text']; ?>
                                                            </div>
                                                    </article>
																								<?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="block" id="comment-add-form">
                                        <h3>Добавить комментарий</h3>
                                        <div class="block__content">
                                            <form class="form" method="post"
                                                  action="/article.php?category=<?php echo $art['id']; ?>#comment-add-form">
																							<?php
																								if (isset($_POST['do_post'])) {
																									$errors = array();
																									if ($_POST ['name'] == ' ') {
																										$errors[] = "Введите имя!";
																									}
																									if ($_POST ['nickname'] == ' ') {
																										$errors[] = "Введите никнейм!";
																									}
																									if ($_POST ['email'] == ' ') {
																										$errors[] = "Введите Email!";
																									}
																									if ($_POST ['text'] == ' ') {
																										$errors[] = "Введите текст комментария!";
																									}
																									if (empty($errors)) {
																									    mysqli_query($connection, "INSERT INTO `comments` (`author`, `nickname`, `email`,`text`,`pubdate`,`article_id`) VALUES (' ".$_POST['name']." ', ' ".$_POST['nickname']." ', ' ".$_POST['email']." ', ' ".$_POST['text']." ', NOW(),  ' ".$art['id']." ') ");
																									    echo "<span style='margin-bottom: 10px; display: block; color: #468847;'> Комментарий успешно добавлен! </span>";
																									} else {
																										echo $errors['0'] . '<hr>';
																									}
																								}

																							?>
                                                <div class="form__group">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form__control" required=""
                                                                   name="name"
                                                                   placeholder="Имя" value="<?php echo $_POST['name']; ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form__control" required=""
                                                                   name="nickname"
                                                                   placeholder="Никнейм" value="<?php echo $_POST['nickname']; ?>">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form__control" required=""
                                                                   name="email"
                                                                   placeholder="Email" value="<?php echo $_POST['email']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form__group">
                                                    <label>
                                        <textarea name="text" required="" class="form__control"
                                                  placeholder="Текст комментария ..."><?php echo $_POST['text']; ?></textarea>
                                                    </label>
                                                </div>
                                                <div class="form__group">
                                                    <input type="submit" class="form__control" name="do_post"
                                                           value="Добавить комментарий">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </section>
                                <section class="content__right col-md-4">
																	<?php echo include "media/includes/sidebar.php" ?>
                                </section>
                            </div>
                        </div>
                    </div>

									<?php include "media/includes/footer.php"; ?>

            </div>

</body>
</html>