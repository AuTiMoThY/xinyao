// > xinyao
const xinyao = (function (window) {

    const debug = 1;

    const breakpoints = {
        "xxs": 0,
        "xs": 375,
        "sm": 576,
        "md": 768,
        "lg": 1024,
        "xl": 1280,
        "xxl": 1366,
        "uxl": 1680
    };

    const mqUp = Object.keys(breakpoints).reduce((acc, key) => {
        acc[key] = window.matchMedia(`(min-width: ${breakpoints[key]}px)`);
        return acc;
    }, {});

    const mqDown = Object.keys(breakpoints).reduce((acc, key, index, arr) => {
        if (index < arr.length - 1) {
            acc[key] = window.matchMedia(`(max-width: ${breakpoints[arr[index + 1]]}px)`);
        }
        return acc;
    }, {});



    // Random number functions
    // https://developer.mozilla.org/zh-TW/docs/Web/JavaScript/Reference/Global_Objects/Math/random#getting_a_random_integer_between_two_values
    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min) + min); //The maximum is exclusive and the minimum is inclusive
    }

    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }

    function getRandomIntInclusive(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1) + min); //The maximum is inclusive and the minimum is inclusive
    }


    // https://medium.com/@mingjunlu/lazy-loading-images-via-the-intersection-observer-api-72da50a884b7
    // Lazy loading...
    function handleLazyLoading() {
        if ('loading' in HTMLImageElement.prototype) {
            console.log('支援原生 lazy loading!!');
        } else {
            // Implement fallback lazy loading here
        }
    }


    const updateCursor = ({ x, y }) => {
        document.documentElement.style.setProperty('--x', x);
        document.documentElement.style.setProperty('--y', y);

        // console.log(x, y);
    }
    document.body.addEventListener('pointermove', updateCursor);

    // const resizeThrottler = (function () {
    //     let resizeTimeout;
    //     return function () {
    //         if (!resizeTimeout) {
    //             resizeTimeout = setTimeout(function () {
    //                 resizeTimeout = null;
    //                 if (mqUp.lg.matches) {
    //                     document.body.classList.remove("js-open-mobile-menu");
    //                 }
    //             }, 66); // Execute at max of 15 fps
    //         }
    //     };
    // })();

    const { ref, createApp, onMounted, watchEffect } = Vue;
    return {
        /**
         * ---------------------------------------------------------------------------------
         * >> .init()
         */

        init() {
            const _ = this;
            document.body.classList.add('js-dom_ready');

            _.resizeThrottler();
            window.addEventListener('resize', _.resizeThrottler());


            if (document.getElementById("goTop")) {
                createApp(this.goTop()).mount("#goTop");
            }
            if (document.getElementById("Aside")) {
                createApp(this.Aside()).mount("#Aside");
            }
            handleLazyLoading();

            new SimpleBar(document.querySelector('.site_aside-bd'));

        },

        resizeThrottler() {
            let resizeTimeout;
            if (!resizeTimeout) {
                resizeTimeout = setTimeout(function () {
                    resizeTimeout = null;
                    if (mqUp.lg.matches) {
                        document.body.classList.remove("js-open-mobile-menu");
                    }
                }, 66); // Execute at max of 15 fps
            }
            // return function () {
            // };
        },

        /**
         * ---------------------------------------------------------------------------------
         * >> .log()  
         */
        log(label, ...args) {
            if (debug) {
                const stack = new Error().stack;
                const callerInfo = stack.split('\n')[2].trim();  // 取得呼叫 `customLog` 的堆疊資訊
                console.log(
                    `%c${label} %c${callerInfo}:%c\n`,
                    "color: brown; font-weight: bolder; font-size: 1.25rem;",  // label 的樣式
                    "color: blue;",   // callerInfo 的樣式
                    "color: black;",  // 重置為預設風格
                    ...args
                );
            }
        },

        /**
         * ---------------------------------------------------------------------------------
         * >> .goTop()
         */

        goTop() {
            return {
                setup() {
                    const goToTop = () => {
                        event.preventDefault();
                        // console.log("gototop");
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth',
                        });
                    };

                    return {
                        goToTop
                    }
                }
            }

        },

        Aside() {
            return {
                setup() {
                    const eventBus = window.eventBus;
                    // const cart_num = ref(JSON.parse(localStorage.getItem('selectedItems') || '[]').length);
                    const cart_num = ref(eventBus.state.selectedItemsCount);
                    const isOpenMenu = ref(eventBus.state.isOpenMenu);
                    const isOpenSearch = ref(eventBus.state.isOpenSearch);

                    const isMobile = ref(eventBus.state.isMobile);

                    // const currentUrl = ref(eventBus.state.currentUrl);
                    const isHomePage = ref(eventBus.state.isHomePage);
                    // console.log(currentUrl);
                    // console.log(baseUrl);

                    watchEffect(() => {
                        cart_num.value = eventBus.state.selectedItemsCount;
                        isOpenMenu.value = eventBus.state.isOpenMenu;
                        isMobile.value = eventBus.state.isMobile;
                        xinyao.log("isMobile", isMobile.value);
                    });

                    const handleSearch = () => {
                        eventBus.toggleSearch();
                        isOpenSearch.value = eventBus.state.isOpenSearch;
                    }

                    const handleMenu = () => {
                        eventBus.toggleMenu();
                        isOpenMenu.value = eventBus.state.isOpenMenu;
                        const simpleBar = new SimpleBar(document.querySelector('.site_aside-bd'));
                        simpleBar.recalculate();
                    }
                    onMounted(() => {
                        // 選擇所有的菜單項目
                        const menuItems = document.querySelectorAll('.site_menu-item');

                        menuItems.forEach(item => {
                            const sublist = item.querySelector('.sublist');
                            const title = item.querySelector('.inner');

                            // 檢查當前項目是否有子列表
                            if (sublist && title) {
                                item.classList.add('has-sublist');
                                // 創建 SVG 元素
                                const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                                // 在這裡添加您的 SVG 屬性
                                svg.setAttribute('data-src', baseUrl + 'assets/images/arrow-down.svg');
                                // 將 SVG 添加到標題中
                                title.appendChild(svg);

                                // 為標題添加點擊事件監聽器
                                title.addEventListener('click', () => {
                                    // 切換 "open-sublist" 類
                                    item.classList.toggle('open-sublist');
                                    // 根據 "open-sublist" 類的存在與否來控制子列表的顯示狀態
                                    // sublist.style.display = item.classList.contains('open-sublist') ? 'block' : 'none';

                                });
                            }
                        });

                        // if (currentUrl === 'http:' + baseUrl) {
                        //     isHomePage.value = true;
                        // }
                    });
                    return {
                        cart_num,
                        eventBus,
                        handleSearch, isOpenSearch,
                        handleMenu, isOpenMenu,
                        isMobile,
                        isHomePage
                    }
                }
            }
        }

    }
}(window));


document.addEventListener('DOMContentLoaded', function () {
    xinyao.init();
});