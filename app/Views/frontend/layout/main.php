<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <?= $this->include("frontend/include/head") ?>
    <?= $this->renderSection("page_head") ?>
</head>

<body id="app">
    <div class="xinyao_goTop" id="goTop">
        <a class="xinyao_goTop-inner" href="javascript:;" @click.prevent="goToTop">
            <i class="fa-solid fa-arrow-up"></i>
        </a>
    </div>
    <!-- ========================================================================= -->
    <!-- .body_wrap  START-->
    <div class="body_wrap">

        <?= $this->include("frontend/layout/aside") ?>

        <?= $this->renderSection("content") ?>

    </div>
    <!-- /.body_wrap  END  !!-->
    <!-- =========================================================================-->

    <?= $this->include("frontend/include/script") ?>
    <?= $this->renderSection("page_script") ?>
</body>

</html>