<template>
    <div style="margin: 10px 20px " >
        <div class="row">
            <div style="background-color: #fff;height: 100vh;" class="col-2">
                <div class="flex-shrink-0 p-3 bg-white"  >
                    <a @click.prevent="$router.push({ name : 'Main' })" href="#" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                        <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
                        <span class="fs-5 fw-semibold">Admin challenge</span>
                    </a>

                    <ul class="list-unstyled ps-0">

                        <li class="mb-1">
                            <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                                Quản lý bài test
                            </button>
                            <div class="collapse" id="dashboard-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li>
                                        <router-link
                                            class="link-dark d-inline-flex text-decoration-none rounded"
                                            :to="{ name : 'AdminChallenge' }">Danh sách</router-link>
                                    </li>
                                    <li>
                                        <router-link
                                            class="link-dark d-inline-flex text-decoration-none rounded"
                                            :to="{ name : 'AdminStoreChallenge' }">Thêm mới </router-link>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="border-top my-3"></li>
                        <li class="mb-1">
                            <button @click.prevent="$router.push({ name: 'Content' })" class="btn d-inline-flex align-items-center rounded border-0 collapsed"  aria-expanded="false">
                                Tranh chính
                            </button>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-10">
                <div class="p-2">
                    <router-view class="p-2" style="background-color: #fff"></router-view>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data(){
        return {

        }
    },
}
</script>

<style scoped>
.dropdown-toggle { outline: 0; }

.btn-toggle {
    padding: .25rem .5rem;
    font-weight: 600;
    color: rgba(0, 0, 0, .65);
    background-color: transparent;
}
.btn-toggle:hover,
.btn-toggle:focus {
    color: rgba(0, 0, 0, .85);
    background-color: #d2f4ea;
}

.btn-toggle::before {
    width: 1.25em;
    line-height: 0;
    content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
    transition: transform .35s ease;
    transform-origin: .5em 50%;
}

.btn-toggle[aria-expanded="true"] {
    color: rgba(0, 0, 0, .85);
}
.btn-toggle[aria-expanded="true"]::before {
    transform: rotate(90deg);
}

.btn-toggle-nav a {
    padding: .1875rem .5rem;
    margin-top: .125rem;
    margin-left: 1.25rem;
}
.btn-toggle-nav a:hover,
.btn-toggle-nav a:focus {
    background-color: #d2f4ea;
}

.scrollarea {
    overflow-y: auto;
}
</style>
