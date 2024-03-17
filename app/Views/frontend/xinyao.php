<?= $this->extend("frontend/layout/main") ?>


<?= $this->section("page_head") ?>
<script>
    const xinyaoData = <?= json_encode($xinyaoData) ?>;
    console.log(xinyaoData);
    const currentSubCateData = <?= json_encode($xinyaoData[$subCateId - 1]['item']) ?>;

    const cateId = {
        main: "<?= $cateId ?>",
        sub: "<?= $subCateId ?>",
    };
    // console.log(currentPage);
    // "<?= 'xinyao-' . $cateId . '-' . $subCateId ?>";
</script>
<?= $this->endSection() ?>
<?= $this->section("content") ?>


<!-- =========================================================================-->
<!-- 頁面內容  START-->
<!-- =========================================================================-->
<main class="page_main page-home" id="xinyaoList">
    <?= $this->include("frontend/include/searchbar") ?>
    <div class="hr" v-if="!isMobile"></div>
    <div class="page_main-container" v-if="!isMobile || (isMobile && !isHomePage)">
        <h1 class="page_main-title txt-main-color">
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
        <div class="xinyao_datatable__wrap">
            <div class="xinyao_datatable">
                <div class="xinyao_datatable-heading">
                    <div class="xinyao_datatable-th name">調理項目</div>
                    <div class="xinyao_datatable-th info">說明</div>
                    <div class="xinyao_datatable-th action">操作</div>
                </div>
                <div class="xinyao_datatable-tr" v-for="(item, index) in data" :key="index">
                    <div class="xinyao_datatable-td name" data-th="調理項目">{{item.name}}</div>
                    <div class="xinyao_datatable-td info" data-th="說明">
                        <p class="txt" v-html="item.directions"></p>
                    </div>
                    <div class="xinyao_datatable-td action" data-th="操作">
                        <div class="action-amount">
                            <amount-field v-model="item.amount"></amount-field>
                            <button type="button" class="action_btn" @click="addToList(item)">加入</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xinyao_datatable-ft"  v-if="isMobile">
            <a href="<?= base_url() ?>" class="xinyao_btn xinyao_btn-nobg">回目錄</a>
            <a href="<?= base_url('cart') ?>" class="xinyao_btn">查看已挑選</a>
        </div>
        <!-- <div class="xinyao_datatable-pagination" v-if="isMobile">
            <button class="xinyao_datatable-pagination-btn" @click="prevDatatable">上一個</button>
            <span class="xinyao_datatable-pagination-number"><span class="current">{{currentDatatable}}</span> / {{totalDatatable}}</span>
            <button class="xinyao_datatable-pagination-btn" @click="nextDatatable">下一個</button>
        </div> -->
    </div>
    <div v-if="showPopupSelect" class="popup popup_select">
        <div class="popup-block">
            <div class="popup-hd ">
                <b class="popup-title txt-main-color">請選擇您不適的部位</b>
                <small class="font-note txt-sub-color">可複選</small>
            </div>
            <div class="popup-bd">
                <div class="select_parts">
                    <ul class="select_parts-list">
                        <li class="select_parts-item" v-for="(part, index) in selectParts">
                            <label :for="'part-' + index" class="item_label">
                                <input type="checkbox" class="item_input--checkbox" :id="'part-' + index" :value="part.part_name" v-model="selectedParts">
                                <div class="select_parts-item-inner">
                                    <span class="label">{{part.part_name}}</span>
                                    <span class="img">
                                        <img :src="part.part_img" :alt="part.part_name">
                                    </span>
                                </div>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="popup-ft">
                <button @click="handleSelection(true)" type="button" class="xinyao_btn xinyao_btn-nobg">無/未知</button>
                <button @click="handleSelection(false)" type="button" class="xinyao_btn" :disabled="!hasSelected">確認</button>
            </div>
            <button @click="showPopupSelect = false" type="button" class="popup-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <notification :show="showNotification" :msgtitle="notificationTitle" :msgcnt="notificationCnt"></notification>
</main>

<!-- /.page_main END  !! -->
<!-- =========================================================================-->
<!-- 頁面內容  END  !!-->
<!-- =========================================================================-->

<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="module" src="<?= js_url('frontend/xinyao.js?v=' . WEB_VERSION) ?>"></script>
<?= $this->endSection() ?>