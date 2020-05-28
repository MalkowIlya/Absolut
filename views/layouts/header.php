<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <link rel="shortcut icon" href="template/images/logo.ico" type="image/x-icon">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/template/js/fotorama.js"></script>
    <script src="/template/js/main.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>

    <script type="text/javascript" src="/template/js/jquery.json-1.3.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/template/css/main.css">
    <link rel="stylesheet" type="text/css" href="/template/css/preloader.css">
    <link rel="stylesheet" href="/template/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed|Bitter" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <!--/head-->
    </head>

    <body>
        <!-- Прелоадер -->
    <!--<div class="loaderArea">
        <div class="loader">
            <div class="loader-inner">
                <div class="loader-line-wrap">
                    <div class="loader-a"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-a"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
                <div class="loader-line-wrap">
                    <div class="loader-line"></div>
                </div>
            </div>
        </div>
    </div>-->


    <div class="wrapper">
        <div class="content">
            <header>

                <div class="header-top-100">
                    <div class="center-block-main header-top clearfix">

                        <div class="header-addres"><p><i class="fa fa-map-marker" aria-hidden="true"></i> Санкт-Петербург, Бухарестская улица 118</p></div>
                        <div class="logo"><img src="/template/images/logo.png" alt="" width="130px"></div>

                        <div class="login-basket">
                            <div class="cent">
                                
                                <?php if(User::isGuest()): ?>
                                    <p class="header-user">
                                        <a href="/user/login/"><i class="fa fa-lock" aria-hidden="true"></i> Вход</a>
                                    </p>

                                <?php else: ?>
                                    <p class="header-user">
                                        <a href="/user/logout/"><i class="fa fa-unlock" aria-hidden="true"></i> Выход</a>
                                    </p>
                                    <p class="header-user">
                                        <a href="/cabinet/"><i class="fa fa-user" aria-hidden="true"></i> Аккаунт</a>
                                    </p>
                                <?php endif; ?>

                                <p class="header-user">
                                    <a href="/cart/" ><i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина (<span id="cart-count"><?php echo Cart::countItems(); ?></span>)</a>
                                </p>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="center-block-main">
                    <div class="header-bottom clearfix">
                        <nav>
                            <div class="show-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <div class="hide-menu">
                                <ul class="menu">
                                    <li><a href="/">Главная</a></li>
                                    <li><a href="/catalog/">Магазин</a></li>
                                    <li><a href="/calc/">Калькулятор</a></li>
                                    <li><a href="/blog/">Полезная информация</a></li>
                                    <li><a href="/about/">О нас</a></li>
                                    <li><a href="/contacts/">Контакты</a></li>
                                </ul>
                            </div>

                            <div class="mobile-menu">
                                <ul>
                                    <li><a href="/">Главная</a></li>
                                    <li><a href="/catalog/">Магазин</a></li>
                                    <li><a href="/calc/">Калькулятор</a></li>
                                    <li><a href="/blog/">Полезная информация</a></li>
                                    <li><a href="/about/">О нас</a></li>
                                    <li><a href="/contacts/">Контакты</a></li>
                                </ul>
                            </div>

                        </nav>
                    </div>
                </div>

            </header>
