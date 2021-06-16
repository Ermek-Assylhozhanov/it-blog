<?php
include '../media/includes/config.php';
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
    <?php include '../media/includes/header.php'; ?>
    <div id="content">
        <div class="container">
            <div class="row">
                <section class="content__left col-md-8">
                    <div class="block">
                        <h3>Обо мне</h3>
                        <div class="block__content">
                            <img class="my_avatar" src="/media/static/images/avatar.jpg" style="width: 100%; height: auto" alt="Avatar">

                            <div class="full-text">
                                <h2>Опыт</h2>

                                <h2>Навыки</h2>
                                <ul>Языки программирования:
                                    <li>Javascript + (HTML, CSS)
                                        <ul>
                                            <li>DOM</li>
                                            <li>ES6</li>
                                        </ul>
                                    </li>
                                    <li>Python</li>
                                    <li>PHP</li>
                                </ul><br>
                                <ul>Владение языками:
                                    <li>Казахский</li>
                                    <li>Русский</li>
                                    <li>Английский</li>
                                </ul>
                                <h2>Образование</h2>
                                <ul>
                                    <li>&bullet; 2016-2018 Колледж МАБ </li>
                                    <li>&bullet; 2018-2021 Алматы Менеджмент Университет</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content__right col-md-4">
                    <?php include '../media/includes/sidebar.php '; ?>
                </section>
            </div>
        </div>
    </div>

    <?php include "../media/includes/footer.php"; ?>

</div>

</body>
</html>