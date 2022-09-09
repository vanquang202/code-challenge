const routers = [
    {
        path: "/",
        name: "Layout",
        component: () =>
            import(/* webpackChunkName: "Chat" */ "../components/App.vue"),
        children: [
            {
                path: "/",
                name: "Content",
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../views/Content.vue"
                    ),
            },
            {
                path: "/challenge/:id",
                name: "ShowContent",
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../views/ShowContent.vue"
                    ),
            },
            {
                path: "/profile",
                name: "Profile",
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../views/Profile.vue"
                        ),
            },
        ],
    },
    {
        path: '/login',
        name: "Login",
        component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../views/Login.vue"
                    ),
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () =>
            import(
                /* webpackChunkName: "ContentChat" */ "../components/Dashboard.vue"
            ),
        children: [
            {
                path: '/',
                name: 'Main',
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../admins/Main.vue"
                        ),
            },
            {
                path: 'challenge',
                name: 'AdminChallenge',
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../admins/Challenge.vue"
                        ),
            },
            {
                path: 'challenge-store',
                name: 'AdminStoreChallenge',
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../admins/StoreChallenge.vue"
                        ),
            },
            {
                path: 'challenge-store/:id/test',
                name: 'AdminChallengeTest',
                component: () =>
                    import(
                        /* webpackChunkName: "ContentChat" */ "../admins/TypeTest.vue"
                        ),
            }
        ],
    }

];

export { routers };
