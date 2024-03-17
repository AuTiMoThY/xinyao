<aside class="site_aside" id="Aside">
    <div class="site_aside-inner" :class="{'js-home_page': isHomePage}">
        <div class="site_aside-hd">
            <div class="site_aside-hd-top">
                <div class="member_info">
                    <div class="icon">
                        <img src="<?= img_url('member-icon.png') ?>" alt="">
                    </div>
                    <div class="txt">
                        <b class="name">潘XX</b>
                        <div class="phone font-body-s">0912-345-678</div>
                    </div>
                </div>
                <div class="ctrl-btns">
                    <button class="ctrl-btn" @click="handleSearch">
                        <img src="<?= img_url('icon-search.svg') ?>" alt="" v-if="!isOpenSearch">
                        <img src="<?= img_url('icon-close.svg') ?>" alt="" v-if="isOpenSearch">
                    </button>
                    <a class="ctrl-btn" href="<?= base_url() ?>">
                        <img src="<?= img_url('icon-home.svg') ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="hr " v-if="isHomePage"></div>
            <div class="member_point">
                <div class="member_point-inner">
                    <div class="font-h3 txt-main-color">1234點</div>
                    <small class="font-note">2024/12/31 到期</small>
                </div>
            </div>
            <div class="site_menu-item" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'cart' }">
                <a class="inner" href="<?= base_url('/cart') ?>">
                    <span class="txt">挑選中調理帖</span>
                    <span class="line"></span>
                    <span class="cart_num">{{cart_num}}</span>
                </a>
            </div>
        </div>
        <div class="hr"></div>
        <div class="site_aside-bd">
            <div class="site_menu__wrap">
                <nav class="site_menu">
                    <strong class="site_menu-title font-h3 txt-Gray-01">新增</strong>
                    <ul class="site_menu-list">
                        <li class="site_menu-item" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'xinyao-2-1' }">
                            <a class="inner font-body-m" href="<?= base_url('/xinyao-2') ?>">緊張應變</a>
                        </li>
                        <li class="site_menu-item" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'xinyao-3-1' }">
                            <a class="inner font-body-m" href="<?= base_url('/xinyao-3') ?>">症狀初期</a>
                        </li>
                        <li class="site_menu-item" :class="{'open-sublist': eventBus.state.isXinyao1}">
                            <div class="inner font-body-m">心藥目錄</div>
                            <ul class="sublist">
                                <?php foreach ($xinyaoIndex as $k => $v) { ?>
                                    <li class="subitem" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'xinyao-1-<?= $k + 1 ?>' }" v-if="!isMobile">
                                        <a href="<?= base_url('/xinyao-1' . '/' . $k + 1) ?>" class="inner">
                                            <div class="txt"><?= $v['txt'] ?></div>
                                            <div class="note">
                                                <?php
                                                $count = count($v['item']);
                                                foreach ($v['item'] as $i_k => $i_v) {
                                                    echo $i_v['name'];
                                                    // 如果不是最后一个项目，则添加斜杠
                                                    if ($i_k !== $count - 1) {
                                                        echo ' / ';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="subitem" v-if="isMobile">
                                        <div class="inner">
                                            <div class="txt"><?= $v['txt'] ?></div>
                                            <div class="note">
                                                <?php foreach ($v['item'] as $i_k => $i_v) { ?>
                                                    <a href="<?= base_url('/xinyao-1' . '/' . $k + 1 . '/' . $i_k + 1) ?>" class="note-link"><?= $i_v['name'] ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <div class="hr"></div>
                <nav class="site_menu">
                    <strong class="site_menu-title font-h3 txt-Gray-01">管理</strong>
                    <ul class="site_menu-list">
                        <li class="site_menu-item" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'history' }">
                            <a class="inner" href="<?= base_url('/history') ?>">調理帖紀錄</a>
                        </li>
                        <li class="site_menu-item" :class="{ 'js-highlight': eventBus.state.highlightedMenuItem === 'favourite' }">
                            <a class="inner" href="<?= base_url('/favourite') ?>">常用調理帖</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="site_aside-ft">
            <a href="<?= base_url('/logout') ?>" class="xinyao_btn">
                <div class="icon">
                    <svg data-src="<?= img_url('icon-logout.svg') ?>"></svg>
                </div>
                <div class="txt">登出</div>
            </a>
        </div>
    </div>
</aside>