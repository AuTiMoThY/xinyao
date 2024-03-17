const { defineStore } = Pinia;

// 定义 Pinia store
export const useGlobalStateStore = defineStore('globalState', {
    state: () => ({

        isOpenSearch: false,
        isOpenMenu: false,
    }),
    actions: {
        toggleSearch() {
            this.isOpenSearch = !this.isOpenSearch;
        },
        toggleMenu() {
            this.isOpenMenu = !this.isOpenMenu;
        },
        // 添加其他 actions 以管理状态
    },
});