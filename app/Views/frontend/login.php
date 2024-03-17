<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <?= $this->include("frontend/include/head") ?>
</head>

<body class="">
    <!-- =========================================================================-->
    <!-- 頁面內容  START-->
    <!-- =========================================================================-->
    <main class="page_main page-login" id="loginApp">
        <div class="brand" style="background-image: url(<?= img_url('login-brand-2x.jpg') ?>);"></div>
        <div class="header-mb" style="background-image: url(<?= img_url('login-header.jpg') ?>);"></div>
        <div class="login_wrap">
            <h1 class="title svg-text">
                <span class="txt">心藥系統</span>
                <svg data-src="<?= img_url('text-XinYaoXiTong.svg') ?>"></svg>
            </h1>
            <div class="login_block">
                <form class="xinyao_frm login_frm" @submit.prevent="login($event)" data-baseurl="<?= base_url() ?>">
                    <div class="xinyao_frm-bd">
                        <section class="form-group row">
                            <div class="col-12">
                                <input-field label="帳號" id="user_id" v-model="user_id" :isrequired="1" placeholder="請輸入手機號碼" :error="fieldErrors.user_id"></input-field>
                            </div>
                        </section>
                        <section class="form-group row">
                            <div class="col-12">
                                <password-field label="密碼" id="user_pw" v-model="user_pw" :isrequired="1" placeholder="請輸入密碼" :error="fieldErrors.user_pw"></password-field>
                            </div>
                        </section>
                        <div class="frm-error txt-danger text-center" v-if="frmError">{{ frmError }}</div> <!-- 顯示錯誤消息 -->
                    </div>
                    <div class="xinyao_frm-ft">
                        <submit-btn default_txt="登入" sending_txt="登入中..." :isdisabled="isdisabled"></submit-btn>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <!-- /.page_main END  !! -->
    <!-- =========================================================================-->
    <!-- 頁面內容  END  !!-->
    <!-- =========================================================================-->

    <script type="text/javascript" src="https://unpkg.com/external-svg-loader@latest/svg-loader.min.js" async></script>
    <!-- script -->
    <script src="<?= js_url('script.js?v=' . WEB_VERSION) ?>"></script>
    <script type="module" src="<?= js_url('frontend/login.js?v=' . WEB_VERSION) ?>"></script>

</body>

</html>