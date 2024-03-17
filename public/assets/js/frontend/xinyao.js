import { amountField, notification } from '../vue-components.js';
import { useNotification, useOpenSearch } from '../vue-composable.js';
import { useGlobalStateStore } from '../globalState.js';

const { ref, createApp, computed, onMounted, onUnmounted, watchEffect } = Vue;
const { createPinia } = Pinia;
const xinyaoListSetup = {
    components: {
        'amount-field': amountField,
        notification
    },
    setup() {
        const {
            main: mainCateId,
            sub: subCateId
        } = cateId;
        xinyao.log("cateId", cateId);
        const currentPage = `xinyao-${mainCateId}-${subCateId}`;
        const { showNotification, notificationTitle, notificationCnt, showNoti, closeNoti } = useNotification();
        const { isOpenSearch } = useOpenSearch();

        // const globalState = useGlobalStateStore();
        // const isOpenSearch = globalState.isOpenSearch;

        const eventBus = window.eventBus;
        const data = ref([]);


        const showPopupSelect = ref(false);
        const hasSelected = computed(() => {
            return selectedParts.value.length > 0;
        });
        const selectParts = ref([]);
        const selectedParts = ref([]); // 用于存储选中的部位名称


        const currentSelectedItem = ref(null); // 用于存储当前选中的调理项目
        const selectedItems = ref(JSON.parse(localStorage.getItem('selectedItems') || '[]')); // 用于存储选中的调理项目




        const isMobile = ref(eventBus.state.isMobile);
        watchEffect(() => {
            isMobile.value = eventBus.state.isMobile;
        });

        xinyao.log(baseUrl);
        const isHomePage = ref(eventBus.state.isHomePage);
        if (eventBus.state.currentUrl === baseUrl || eventBus.state.currentUrl === "http://localhost:3000/") {
            eventBus.updateIsHomePage();
        }
        watchEffect(() => {
            isHomePage.value = eventBus.state.isHomePage;
        });
        xinyao.log("isHomePage", isHomePage.value);


        // const currentSubCateDatatable = ref(1);
        // const totalDatatable = ref(0);
        // const pageSize = ref(1);
        // const startIndex = computed(() => {
        //     return (currentSubCateDatatable.value - 1) * pageSize.value;
        // });
        // const endIndex = computed(() => {
        //     return startIndex.value + pageSize.value;
        // });

        // const prevDatatable = () => {
        //     if (currentSubCateDatatable.value > 1) {
        //         currentSubCateDatatable.value--;
        //         data.value = currentSubCateData.slice(startIndex.value, endIndex.value);
        //     }
        // }
        // const nextDatatable = () => {
        //     if (currentSubCateDatatable.value < totalDatatable.value) {
        //         currentSubCateDatatable.value++;
        //         data.value = currentSubCateData.slice(startIndex.value, endIndex.value);
        //     }
        // }

        // xinyao.log("localStorage selectedItems", selectedItems.value);


        const addToList = (item) => {
            // 取調理項目名稱、id
            // xinyao.log("addToList() item", item);
            currentSelectedItem.value = {
                name: item.name,
                amount: item.amount
            };
            const parts = item.parts;
            openPopup(parts);
            // xinyao.log("addToList() currentSelectedItem.value", currentSelectedItem.value);
        }

        // 開啟彈出視窗，顯示部位
        const openPopup = (parts) => {
            // xinyao.log("openPopup parts", parts);
            selectParts.value = parts; // 當前項目的部位資訊
            showPopupSelect.value = true; // 显示弹窗
        };

        // 關閉彈出視窗
        const closePopup = () => {
            selectParts.value = [];
            showPopupSelect.value = false;
            selectedParts.value = [] // 清空選擇的部位
        };

        const handleSelection = (isUnknown) => {

            if (isUnknown) {
                // 點擊"無/未知"
                selectedItems.value.push(currentSelectedItem.value);
                addToCart();
            } else {
                // 點擊"確認"
                if (selectedParts.value.length > 0) {
                    // selectedItems.value.push({
                    //     ...currentSelectedItem.value,
                    //     selectedParts: selectedParts.value
                    // });
                    selectedParts.value.forEach(part => {
                        selectedItems.value.push({
                            ...currentSelectedItem.value,
                            part: part
                        });
                    });
                    addToCart();
                } else {
                    alert('請至少選擇一個部位');
                }
            }

            xinyao.log("selectedItems.value", selectedItems.value);
        };

        const addToCart = () => {
            // 将选中的项目和部位存储在 Local Storage 中
            localStorage.setItem('selectedItems', JSON.stringify(selectedItems.value));

            // xinyao.log("localStorage selectedItems", selectedItems.value);
            // xinyao.log("selectedItems.value.length", selectedItems.value.length);

            eventBus.setSelectedItemsCount(selectedItems.value.length);
            showNoti('加入成功', `您可以到<a class="link" href="${baseUrl}cart">挑選中調理帖</a>查看已加入的調理項目。`);
            closePopup();
        };


        const clearSelectedItems = () => {
            localStorage.removeItem('selectedItems');
            // 如果你需要更新组件内的反应式状态，确保也重置它
            selectedItems.value = [];
        };


        onMounted(() => {
            xinyao.log("currentSubCateData", currentSubCateData);
            if (currentPage.includes("xinyao-1")) {
                eventBus.openXinyao1();
            }
            else {
                eventBus.closeXinyao1();
            }
            eventBus.setHighlightedMenuItem(currentPage);
            selectedItems.value = JSON.parse(localStorage.getItem('selectedItems') || '[]');



            // 判斷是否手機版
            if (isMobile.value) {
                const currentUrl = eventBus.state.currentUrl;

                // 判斷是否心藥目錄
                if (mainCateId == "1") {
                    const match = currentUrl.match(/\/xinyao-1\/(\d+)\/(\d+)\/?$/);
                    xinyao.log("match", match);

                    if (match) {
                        const itemId = parseInt(match[2]); // 获取匹配到的項目編號参数

                        const startIndex = (itemId - 1) * 1;
                        const endIndex = startIndex + 1;
                        data.value = currentSubCateData.slice(startIndex, endIndex);
                        data.value.forEach(item => {
                            item.amount = 1;
                        });
                    } else {
                        console.log("未找到URL中的參數");

                        if (!isHomePage.value) {
                            window.location.href = baseUrl;
                        }
                    }
                }
                else {
                    data.value = currentSubCateData;
                    data.value.forEach(item => {
                        item.amount = 1;
                    });
                }
            }
            else {
                data.value = currentSubCateData;
                data.value.forEach(item => {
                    item.amount = 1;
                });
            }



            // data.value.forEach(item => {
            //     item.amount = 1;
            // });

            // const updateIsMobile = () => {
            //     isMobile.value = window.matchMedia('(max-width: 576px)').matches;
            //     if(isMobile.value) {

            //         data.value = currentSubCateData.slice(startIndex.value, endIndex.value);

            //     }
            //     else {
            //         data.value = currentSubCateData;
            //     }
            //     totalDatatable.value = currentSubCateData.length;
            //     data.value.forEach(item => {
            //         item.amount = 1; // 默认值为1，或根据需要设置
            //     });

            //     xinyao.log("data", data.value);
            // };

            // // 初始加载时执行一次，以确保isMobile的值正确
            // updateIsMobile();

            // // 添加窗口大小变化时的事件监听器
            // window.addEventListener('resize', updateIsMobile);

            // // 在组件销毁时移除事件监听器，防止内存泄漏
            // onUnmounted(() => {
            //     window.removeEventListener('resize', updateIsMobile);
            // });
        });

        return {
            // ...Pinia.piniaStoreToRefs(globalState), ...globalState,
            data,
            showPopupSelect, selectParts, selectedParts, handleSelection, hasSelected,
            showNotification, notificationTitle, notificationCnt,
            addToList,
            clearSelectedItems,
            // currentSubCateDatatable, totalDatatable, prevDatatable, nextDatatable,
            isOpenSearch,
            isMobile,
            isHomePage
        }
    }

}

const xinyaoList = createApp(xinyaoListSetup);
const pinia = createPinia();
xinyaoList.config.compilerOptions.isCustomElement = (tag) => {
    return tag.startsWith('module-')
}
xinyaoList.use(pinia);
xinyaoList.mount("#xinyaoList");
