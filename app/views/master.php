<html>
<head>
    <title>static page navigation</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/jquery.sidr.light.css') ?>"/>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/style.css') ?>"/>
    <script src="//code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="<?php echo site_url('assets/js/jquery.sidr.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('.side-menu-toggle').sidr({
                displace: false
            });
        });
    </script>
</head>

<body>

<div id="sidr">

    <h2>Pages</h2>

    <ul>
        <?php
        if (isset($pages) && $pages):
            foreach ($pages as $p):
                ?>
                <li class="<?php echo ($p->isActive) ? 'active' : ''?>">
                    <a href="<?php echo site_url($p->folder)?>"><?php echo $p->title?></a>
                </li>
            <?php
            endforeach;
        endif;
        ?>

    </ul>
</div>



<!--<div id="outer-wrap">-->
<!--    <div id="inner-wrap">-->

        <header id="top" role="banner" class="side-menu-toggle" title="MENU">
            <div class="block">
                <h1 class="block-title">Your company name here</h1>
                <a class="nav-btn side-menu-toggle" id="simple-menu" href="#">Navigation</a>
            </div>
        </header>

        <div id="main" role="main">
            <article class="block prose">

                <?php
                echo $page;
                ?>

            </article>
        </div>


<!--    </div>-->
    <!--/#inner-wrap-->
<!--</div>-->
<!--/#outer-wrap-->


</body>

</html>