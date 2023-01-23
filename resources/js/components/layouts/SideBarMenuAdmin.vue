<template>
    <aside :class="(menuState)? 'show-menu':'toggle-menu'">
        <div class="menu-top">
            <div class="company-name" v-if="menuState">
                Dogomaniacy
            </div>

            <div class="button-toggle" v-if="menuState">
                <button type="button" @click="toggleMenu()">
                    <font-awesome-icon icon="fa-solid fa-bars"/>
                </button>
            </div>

            <div class="menu-wrap">
                <ul>
                    <li class="menu-items" v-if="!menuState">
                        <a href="#" @click="toggleMenu()">
                            <font-awesome-icon icon="fa-solid fa-bars"/>
                        </a>
                    </li>
                    <li class="menu-items">
                        <a :href="routeShow" target="_blank">
                            <font-awesome-icon icon="fa-solid fa-earth-europe"/>
                            <span v-if="menuState">Podgląd</span></a>
                    </li>
                    <li class="menu-items">
                        <a :href="routeDashboard">
                            <font-awesome-icon icon="fa-solid fa-table-columns"/>
                            <span v-if="menuState">Pulpit</span></a>
                    </li>
                    <li class="menu-items">
                        <a :href="routeScarves">
                            <font-awesome-icon icon="fa-solid fa-vest"/>
                            <span v-if="menuState">Apaszki</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="menu-footer">
            <div class="user-name">{{ userName }}</div>
            <a :href="routeLogout" class="btn-logout" @click="logout($event)">Wyloguj</a>
            <form id="logout-form" :action="routeLogout" method="POST" class="d-none">
                <input type="hidden" name="_token" :value="csrfToken">
            </form>
        </div>
    </aside>
</template>


<script>

export default {
    data() {
        return {
            menuState: true,
            logo: '../../assets/logo.png',
        }
    },

    props: ['routeDashboard', 'routeScarves', 'routeLogout', 'routeShow', 'userName', 'csrfToken'],

    mounted() {
        this.menuState =  !(window.innerWidth < 1024)
    },

    methods: {
        toggleMenu() {
            this.menuState = !this.menuState
        },
        logout(e) {
            e.preventDefault();
            document.getElementById('logout-form').submit()
        }
    }
}
</script>

<style lang="scss" scoped>
aside {
    min-height: 100vH;
    padding: 6px 20px 6px 20px;
    z-index: 99;
    transition: all .5s ease;
    background: #11101d;
    color: #fff;
    min-width: 250px;
    display: flex;
    justify-content: space-between;
    flex-direction: column;

    .menu-top {
        position: relative;
    }
    &.toggle-menu {
        padding: 6px;
        min-width: 0;

        .menu-items {
            a {
                transition: all .5s ease;

                &:hover {
                    transform: scale(1.3);
                }

                svg {
                    margin: 0
                }
            }
        }

    }

    ul {
        list-style: none;
        padding: 0;
    }

    .company-name {
        font-size: 25px;
    }

    .button-toggle {
        position: absolute;
        top: 6px;
        right: 6px;

        button {
            background: transparent;
            border: none;
            color: #fff;
            font-size: 25px;
            transition: all .5s ease;

            &:hover {
                transform: scale(1.3);
            }
        }
    }

    .menu-items {
        width: 100%;
        padding: 10px;

        a {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            letter-spacing: 1.1px;
            transition: all .5s ease;

            svg {
                margin-right: 20px;
                font-size: 25px;
            }
        }

        &:hover {
            a {
                color: #ddd;
                letter-spacing: 1.8px;
            }
        }
    }
}
</style>