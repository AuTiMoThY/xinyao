<div class="search_bar" :class="{'js-open': isOpenSearch}">
    <div class="search_bar-field">
        <div class="search_bar-icon">
            <svg data-src="<?= img_url('icon-search.svg') ?>"></svg>
        </div>
        <input type="text" class="search_bar-input" placeholder="搜尋調理項目">
    </div>
    <div class="search_bar-btn">
        <button class="xinyao_btn" type="button">搜尋</button>
    </div>
</div>