<template>
    <aside :class="(menuState)? 'show-menu':'toggle-menu'">
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
                    <a href="/admin/dashboard">
                        <font-awesome-icon icon="fa-solid fa-table-columns"/>
                        <span v-if="menuState">Pulpit</span></a>
                </li>
                <li class="menu-items">
                    <a href="/admin/dashboard">
                        <font-awesome-icon icon="fa-solid fa-vest"/>
                        <span v-if="menuState">Apaszki</span></a>
                </li>
            </ul>
        </div>
    </aside>
</template>


<script>

export default {
    data() {
        return {
            menuState: true,
            logo: '../../assets/logo.png'
        }
    },

    mounted() {
    },
    methods: {
        toggleMenu() {
            this.menuState = !this.menuState
        }
    }
}
</script>

<style lang="scss" scoped>
aside {
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

    position: fixed;
    left: 0;
    top: 0;
    height: 100vH;
    padding: 6px 20px 6px 20px;
    z-index: 99;
    transition: all .5s ease;
    background: #11101d;
    color: #fff;
    min-width: 250px;

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