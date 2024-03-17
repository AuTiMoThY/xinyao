<?= $this->extend("frontend/layout/main") ?>


<?= $this->section("page_head") ?>
<script>
    const favouriteData = <?= json_encode($favouriteData) ?>;
    console.log(favouriteData);
</script>
<?= $this->endSection() ?>
<?= $this->section("content") ?>

<!-- =========================================================================-->
<!-- 頁面內容  START-->
<!-- =========================================================================-->
<?php
?>
<main class="page_main page-favourite" id="favourite">
    <?= $this->include("frontend/include/searchbar") ?>
    <div class="hr"></div>
    <div class="page_main-container">
        <h1 class="page_main-title txt-main-color">
            <?= $page_title ?>
        </h1>
        <div class="favourite__datatable grid-table">
            <div class="favourite__datatable-heading grid-tablerow">
                <div class="favourite__datatable-td grid-cell p_name">調理帖名稱</div>
                <div class="favourite__datatable-td grid-cell p_value">調理值</div>
                <div class="favourite__datatable-td grid-cell action">操作</div>
            </div>
            <div class="favourite__datatable-data grid-tablerow" v-for="(item, index) in data" :key="index">
                <div class="favourite__datatable-td grid-cell p_name" data-th="名稱">{{item.p_name}}</div>
                <div class="favourite__datatable-td grid-cell p_value" data-th="調理值">{{item.p_value}}</div>
                <div class="favourite__datatable-td grid-cell action" data-th="操作">
                    <button class="action_btn" @click="toggleMenu(index)">
                        <svg data-src="<?= img_url('icon-dropdownmenu.svg') ?>"></svg>
                    </button>
                    <div class="action_menu" v-show="currentActionMenuIndex === index">
                        <button class="action_menu-btn" @click="showDetail(item)">
                            <span class="icon">
                                <svg data-src="<?= img_url('icon-info.svg') ?>"></svg>
                            </span>
                            <span class="txt">調理帖明細</span>
                        </button>
                        <div class="hr"></div>
                        <button class="action_menu-btn" @click="playItem(item)">
                            <span class="icon">
                                <svg data-src="<?= img_url('icon-play_circle.svg') ?>"></svg>
                            </span>
                            <span class="txt">運行</span>
                        </button>
                        <div class="hr"></div>
                        <button class="action_menu-btn" @click="removeItem(index)">
                            <span class="icon">
                                <svg data-src="<?= img_url('icon-delete.svg') ?>"></svg>
                            </span>
                            <span class="txt">刪除</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="showPopupDetail" class="popup popup_detail">
        <div class="popup-block">
            <div class="popup-hd ">
                <b class="popup-title txt-main-color">調理帖明細</b>
            </div>
            <div class="popup-bd">
                <div class="favourite_detail__datatable grid-table">
                    <div class="favourite_detail__datatable-heading grid-tablerow">
                        <div class="favourite_detail__datatable-th grid-cell name">調理項目</div>
                        <div class="favourite_detail__datatable-th grid-cell amount">份量</div>
                    </div>
                    <div class="grid-tablerow favourite_detail__datatable-list" v-for="(item, index) in favourite_detail_arr" :key="index">
                        <div class="favourite_detail__datatable-td grid-cell name" data-th="調理項目">{{ item.item_name }}</div>
                        <div class="favourite_detail__datatable-td grid-cell amount" data-th="份量">{{ item.item_amount }}</div>
                    </div>
                    <div class="grid-tablerow favourite_detail__datatable-total">
                        <div class="favourite_detail__datatable-td grid-cell name" data-th="調理項目">調理值</div>
                        <div class="favourite_detail__datatable-td grid-cell amount" data-th="份量">{{ favourite_detail_value_sum }}</div>
                    </div>
                </div>
            </div>
            <div class="popup-ft">
            </div>
            <button @click="showPopupDetail = false" type="button" class="popup-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <!-- <notification :show="showNotification" :msgtitle="notificationTitle" :msgcnt="notificationCnt"></notification> -->
    <div class="dialog" v-if="showDialog && data[currentActionMenuIndex]">
        <div class="dialog-block">
            <div class="dialog-title">刪除確認</div>
            <div class="dialog-cnt">您確定要刪除<button class="link" @click="showDetail(data[currentActionMenuIndex])">{{ data[currentActionMenuIndex].p_name }}</button>嗎?</div>
            <div class="dialog-btns">
                <button @click="handleRemove(currentActionMenuIndex)" type="button" class="xinyao_btn xinyao_btn-nobg">刪除</button>
                <button @click="showDialog = false" type="button" class="xinyao_btn">保留</button>
            </div>
        </div>
    </div>
</main>

<!-- /.page_main END  !! -->
<!-- =========================================================================-->
<!-- 頁面內容  END  !!-->
<!-- =========================================================================-->

<?= $this->endSection() ?>

<?= $this->section("page_script") ?>
<script type="module" src="<?= js_url('frontend/favourite.js?v=' . WEB_VERSION) ?>"></script>
<?= $this->endSection() ?>