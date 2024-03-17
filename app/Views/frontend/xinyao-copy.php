<?= $this->extend("frontend/layout/main") ?>


<?= $this->section("page_head") ?>
<script>
    const xinyaoData = <?= json_encode($xinyaoData) ?>;
    const currentData = <?= json_encode($xinyaoData[$subCateId - 1]['item']) ?>;
    console.log(xinyaoData);
    console.log(currentData);
</script>
<?= $this->endSection() ?>
<?= $this->section("content") ?>

<!-- =========================================================================-->
<!-- 頁面內容  START-->
<!-- =========================================================================-->
<?php
?>
<main class="page_main page-home" id="xinyaoList">
    <?= $this->include("frontend/include/searchbar") ?>
    <div class="hr"></div>
    <div class="page_main-container">
        <div class="xinyao_datatable__wrap">
            <h1 class="title font-h1 txt-main-color">
                <?php
                if ($cateId == '1') {

                    echo "心藥目錄：" . $xinyaoData[$subCateId - 1]['txt'];
                } elseif ($cateId == '2') {
                    echo "緊張應變";
                } elseif ($cateId == '3') {
                    echo "症狀初期";
                }
                ?>
            </h1>
            <div class="xinyao_datatable">
                <div class="xinyao_datatable-heading">
                    <div class="xinyao_datatable-th name">調理項目</div>
                    <div class="xinyao_datatable-th info">說明</div>
                    <div class="xinyao_datatable-th action">操作</div>
                </div>
                <?php foreach ($xinyaoData[$subCateId - 1]['item'] as $k => $v) { ?>
                    <div class="xinyao_datatable-tr" data-xinyaoid="">
                        <div class="xinyao_datatable-td name" data-th="調理項目"><?= $v['name'] ?></div>
                        <div class="xinyao_datatable-td info" data-th="說明">
                            <p class="txt"><?= $v['directions'] ?></p>
                        </div>
                        <div class="xinyao_datatable-td action" data-th="操作">
                            <div class="action-amount">
                                <amount-field v-model="amount"></amount-field>
                                <button type="button" class="action_btn" @click="addToList()">加入</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- <div v-if="showPopupSelect" class="popup popup_select">
        <div class="popup-block">
            <div class="popup-hd font-h1 txt-main-color">請選擇您不適的部位</div>
            <div class="popup-bd">
                <div class="select_parts">
                    <ul class="select_parts-list">
                        <li class="select_parts-item">
                            <label for="generateID" class="item_label">
                                <input type="checkbox" class="item_input--checkbox" name="itemKey" id="generateID" :value="item.label" v-model="value" @change="handleCheckboxChange">
                                <div class="select_parts-item-inner">
                                    <span class="img">
                                        <img :src="item.image" alt="">
                                    </span>
                                </div>
                                <span class="label">{{ item.label }}</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <button @click="showPopupSelect = false" class="popup-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div> -->
</main>

<!-- /.page_main END  !! -->
<!-- =========================================================================-->
<!-- 頁面內容  END  !!-->
<!-- =========================================================================-->

<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="module" src="<?= js_url('frontend/xinyao.js?v=' . WEB_VERSION) ?>"></script>
<?= $this->endSection() ?>