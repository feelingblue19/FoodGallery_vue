require("./bootstrap");

window.Vue = require("vue");

import VueRouter from "vue-router";
import VueSession from "vue-session";
Vue.use(VueRouter);
Vue.use(VueSession);

const AppLayout = Vue.component("app-layout",require("./components/appLayout.vue"));
const ContentLayout = Vue.component("content-layout",require("./components/contentLayout.vue"));
const HomeContent = Vue.component("HomeComponent",require("./components/homeComponent.vue"));
const FoodReview = Vue.component("FoodReview",require("./components/foodReview.vue"));
const FoodRecipe = Vue.component("FoodRecipe",require("./components/foodRecipe.vue"));
const CafeReview = Vue.component("CafeReview",require("./components/cafeReview.vue"));
const WriteReview = Vue.component("WriteReview",require("./components/writeReview"));
const WriteRecipe = Vue.component("WriteRecipe",require("./components/writeRecipe.vue"));
const WriteCafe = Vue.component("WriteCafe",require("./components/writeCafe.vue"));
const EditReview = Vue.component("EditReview",require("./components/editReview.vue"));
const EditRecipe = Vue.component("EditRecipe",require("./components/editRecipe.vue"));
const EditCafe = Vue.component("EditCafe", require("./components/editCafe.vue"));
const DetailReview = Vue.component("DetailReview",require("./components/detailReview.vue"));
const DetailRecipe = Vue.component("DetailRecipe",require("./components/detailRecipe.vue"));
const DetailCafe = Vue.component("DetailCafe",require("./components/detailCafe.vue"));
const ProfileLayout = Vue.component("ProfileLayout",require("./components/profileLayout.vue"));
const LoginLayout = Vue.component("LoginLayout",require("./components/loginLayout.vue"));
const RegisterLayout = Vue.component("RegisterLayout",require("./components/registerLayout.vue"));
const EditProfile = Vue.component("EditProfile",require("./components/editProfile.vue"));

const AdminLayout = Vue.component("AdminLayout", require("./components/adminLayout.vue"));
const AdminUser = Vue.component("AdminUser", require("./components/adminUser.vue"));
const AdminReview = Vue.component("AdminReview", require("./components/adminReview.vue"));
const AdminRecipe = Vue.component("AdminRecipe", require("./components/adminRecipe.vue"));
const AdminCafe = Vue.component("AdminCafe", require("./components/adminCafe.vue"));

const routes = [
    {
        path: "/",
        //name: 'contentLayout',
        component: ContentLayout,
        children: [
            {
                path: "",
                name: "homeContent",
                component: HomeContent
            },
            {
                path: "foodreview",
                name: "foodReview",
                component: FoodReview
            },
            {
                path: "foodrecipe",
                name: "foodRecipe",
                component: FoodRecipe
            },
            {
                path: "cafereview",
                name: "cafeReview",
                component: CafeReview
            },
            {
                path: "writereview",
                name: "writeReview",
                component: WriteReview
            },
            {
                path: "writerecipe",
                name: "writeRecipe",
                component: WriteRecipe
            },
            {
                path: "writecafe",
                name: "writeCafe",
                component: WriteCafe
            },
            {
                path: "detailreview/:userid/:id",
                name: "detailReview",
                component: DetailReview,
                props: true
            },
            {
                path: "detailrecipe/:userid/:id",
                name: "detailRecipe",
                component: DetailRecipe,
                props: true
            },
            {
                path: "detailcafe/:userid/:id",
                name: "detailCafe",
                component: DetailCafe,
                props: true
            },
            {
                path: "profile/:userid",
                name: "profile",
                component: ProfileLayout,
                props: true
            },
            {
                path: "editreview/:id",
                name: "editReview",
                component: EditReview,
                props: true
            },
            {
                path: "editrecipe/:id",
                name: "editRecipe",
                component: EditRecipe,
                props: true
            },
            {
                path: "editcafe/:id",
                name: "editCafe",
                component: EditCafe,
                props: true
            }
        ]
    },
    {
        path: "/login",
        name: "login",
        component: LoginLayout,
        props: true
    },
    {
        path: "/register",
        name: "register",
        component: RegisterLayout,
        props: true
    },
    {
        path: "/editprofile/:userid",
        name: "editProfile",
        component: EditProfile,
        props: true
    },
    {
        path: "/admin",
        name: "adminLayout",
        component: AdminLayout,
        children:[
            {
                path: "user",
                name: "adminUser",
                component: AdminUser,
            },
            {
                path: "review",
                name: "adminReview",
                component: AdminReview,
            },
            {
                path: "recipe",
                name: "adminRecipe",
                component: AdminRecipe,
            },
            {
                path: "cafe",
                name: "adminCafe",
                component: AdminCafe,
            }
        ]
    }
];

const router = new VueRouter({ mode: "history", routes });

new Vue(Vue.util.extend({ router }, AppLayout)).$mount("#app");
