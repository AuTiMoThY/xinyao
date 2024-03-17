<?= $this->extend("frontend/layout/main") ?>


<?= $this->section("page_head") ?>
<script>
    const historyData = <?= json_encode($historyData) ?>;
    console.log(historyData);
</script>
<?= $this->endSection() ?>
<?= $this->section("content") ?>

<!-- =========================================================================-->
<!-- 頁面內容  START-->
<!-- =========================================================================-->
<?php
?>
<main class="page_main page-history" id="history">
    <?= $this->include("frontend/include/searchbar") ?>
    <div class="hr"></div>
    <div class="page_main-container">
        <h1 class="page_main-title txt-main-color">
            <?= $page_title ?>
        </h1>
        <div class="history__datatable grid-table">
            <div class="history__datatable-heading grid-tablerow">
                <div class="history__datatable-td grid-cell status">狀態</div>
                <div class="history__datatable-td grid-cell order_num">單號</div>
                <div class="history__datatable-td grid-cell p_name">名稱</div>
                <div class="history__datatable-td grid-cell p_value">調理值</div>
                <div class="history__datatable-td grid-cell p_time">時效</div>
                <div class="history__datatable-td grid-cell p_point">花費點數</div>
                <div class="history__datatable-td grid-cell billing_date">開單日期</div>
                <div class="history__datatable-td grid-cell run_date">運行日期</div>
                <div class="history__datatable-td grid-cell action">操作</div>
            </div>
            <div class="history__datatable-data grid-tablerow" v-for="(item, index) in data" :key="index">
                <div class="history__datatable-td grid-cell status" :class="setStatusClass(item)" data-th="狀態">{{item.status}}</div>
                <div class="history__datatable-td grid-cell order_num" data-th="單號">{{item.order_num}}</div>
                <div class="history__datatable-td grid-cell p_name" data-th="名稱">{{item.p_name}}</div>
                <div class="history__datatable-td grid-cell p_value" data-th="調理值">{{item.p_value}}</div>
                <div class="history__datatable-td grid-cell p_time" data-th="時效">{{item.p_time}}小時</div>
                <div class="history__datatable-td grid-cell p_point" data-th="花費點數">{{item.p_point}}</div>
                <div class="history__datatable-td grid-cell billing_date" data-th="開單日期">{{item.billing_date}}</div>
                <div class="history__datatable-td grid-cell run_date" data-th="運行日期">{{item.run_date}}</div>
                <div class="history__datatable-td grid-cell action" data-th="操作">
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
                        <template v-if="item.status != '已完成' && item.status != '已取消'">
                            <div class="hr"></div>
                            <button class="action_menu-btn" @click="openCancel">
                                <span class="icon">
                                    <svg data-src="<?= img_url('icon-cancel.svg') ?>"></svg>
                                </span>
                                <span class="txt">取消運行</span>
                            </button>
                        </template>
                        <template v-if="item.status !== '等待中' && item.status !== '運行中'">
                            <div class="hr"></div>
                            <button class="action_menu-btn" @click="replay(item)">
                                <span class="icon">
                                    <svg data-src="<?= img_url('icon-replay.svg') ?>"></svg>
                                </span>
                                <span class="txt">再次運行</span>
                            </button>
                        </template>
                        <div class="hr"></div>
                        <button class="action_menu-btn" @click="addFav">
                            <span class="icon">
                                <svg data-src="<?= img_url('icon-kid_star.svg') ?>"></svg>
                            </span>
                            <span class="txt">加入常用</span>
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
                <div class="history_detail__datatable grid-table">
                    <div class="history_detail__datatable-heading grid-tablerow">
                        <div class="history_detail__datatable-th grid-cell name">調理項目</div>
                        <div class="history_detail__datatable-th grid-cell amount">份量</div>
                    </div>
                    <div class="grid-tablerow history_detail__datatable-list" v-for="(item, index) in history_detail_arr" :key="index">
                        <div class="history_detail__datatable-td grid-cell name" data-th="調理項目">{{ item.item_name }}</div>
                        <div class="history_detail__datatable-td grid-cell amount" data-th="份量">{{ item.item_amount }}</div>
                    </div>
                    <div class="grid-tablerow history_detail__datatable-total">
                        <div class="history_detail__datatable-td grid-cell name" data-th="調理項目">調理值</div>
                        <div class="history_detail__datatable-td grid-cell amount" data-th="份量">{{ history_detail_value_sum }}</div>
                    </div>
                </div>
            </div>
            <div class="popup-ft">
            </div>
            <button @click="closePopupDetail" type="button" class="popup-close"><i class="fa-solid fa-xmark"></i></button>
        </div>
    </div>
    <notification :show="showNotification" :msgtitle="notificationTitle" :msgcnt="notificationCnt"></notification>

    <div class="dialog" v-if="showDialog && data[currentActionMenuIndex]">
        <div class="dialog-block">
            <div class="dialog-title">取消確認</div>
            <div class="dialog-cnt">您確定要取消運行<button class="link" @click="showDetail(data[currentActionMenuIndex])">{{ data[currentActionMenuIndex].p_name }}</button>嗎?</div>
            <div class="dialog-btns">
                <button @click="handleCancel(data[currentActionMenuIndex])" type="button" class="xinyao_btn xinyao_btn-nobg">取消運行</button>
                <button @click="showDialog = false" type="button" class="xinyao_btn">保留運行</button>
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
<script type="module" src="<?= js_url('frontend/history.js?v=' . WEB_VERSION) ?>"></script>
<?= $this->endSection() ?>