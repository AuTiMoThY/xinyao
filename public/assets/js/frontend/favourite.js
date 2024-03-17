import { amountField, notification } from '../vue-components.js';
import { useNotification } from '../vue-composable.js';

const { ref, createApp, computed, onMounted, watchEffect } = Vue;
const favouriteSetup = {
    components: {
        'amount-field': amountField,
        notification
    },
    setup() {
        const eventBus = window.eventBus;
        const data = ref(favouriteData);

        const currentActionMenuIndex = ref(null);

        const toggleMenu = (index) => {
            if (currentActionMenuIndex.value === index) {
                // 如果点击的是当前已打开的菜单，则关闭它
                currentActionMenuIndex.value = null;

            } else {
                // 否则，设置当前打开的菜单索引为点击的菜单索引
                currentActionMenuIndex.value = index;

            }
        };


        onMounted(() => {
            eventBus.setHighlightedMenuItem("favourite");

        });

        const favourite_detail_arr = ref([]);
        const favourite_detail_value_sum = ref(0);
        const showPopupDetail = ref(false);
        const showDialog = ref(false);
        const showDetail = (item) => {

            showPopupDetail.value = true;
            favourite_detail_arr.value = item.p_detail;

            item.p_detail.map(detailItem => favourite_detail_value_sum.value = favourite_detail_value_sum.value + parseInt(detailItem.item_amount));
            xinyao.log("showDetail item", item.p_detail);
        }

        const playItem = (item) => {
            localStorage.removeItem('replay');
            xinyao.log("replay item", item);
            localStorage.setItem('replay', JSON.stringify(item));
            window.location.href = `${baseUrl}cart2?from=fav`;
        }
        // 移除調理項目
        const removeItem = (index) => {
            showDialog.value = true;
            currentActionMenuIndex.value = index;
        }
        
        const handleRemove = (index) => {
            data.value.splice(index, 1);
            
            showDialog.value = false;
            currentActionMenuIndex.value = null;
        }

        const isOpenSearch = ref(eventBus.state.isOpenSearch);
        watchEffect(() => {
            isOpenSearch.value = eventBus.state.isOpenSearch;
        });

        return {
            data,
            currentActionMenuIndex, toggleMenu,
            showDetail,
            showPopupDetail,
            showDialog,
            favourite_detail_arr, favourite_detail_value_sum,
            playItem,
            removeItem, handleRemove,
            isOpenSearch
        }
    }

}

const favourite = createApp(favouriteSetup);
favourite.config.compilerOptions.isCustomElement = (tag) => {
    return tag.startsWith('module-')
}
favourite.mount("#favourite");
