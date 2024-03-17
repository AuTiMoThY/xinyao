<title><?= esc($page_title) ?> | 佛印山心藥系統</title>

<meta http-equiv="Cache-Control" content="no-store" />

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<?= $this->include("frontend/include/favicon") ?>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="robots" content="noindex,nofollow">
<meta name="viewport" content="width=device-width, user-scalable=no">
<!-- 讓手機不判斷它是電話號碼變顏色-->
<meta name="format-detection" content="telephone=no">

<!-- google font -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+TC:wght@400;500;600&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
<!-- <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/flatpickr.min.css"> -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->

<link
  rel="stylesheet"
  href="https://unpkg.com/simplebar@latest/dist/simplebar.css"
/>
<script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script>

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="https://unpkg.com/vue-demi"></script>
<script src="https://unpkg.com/pinia"></script>

<script>
  const baseUrl = '<?= base_url() ?>';
</script>


<?= link_tag(css_url("style.css?v=" . WEB_VERSION)) ?>
