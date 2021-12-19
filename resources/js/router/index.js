import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from "../components/home";
import MyProfile from "../components/MyProfile";
import Profile from "../components/Profile";
import Interests from "../components/Interests";
import Complete from "../components/Complete";
import Activate from "../components/Activation";
import Chat from "../components/Chat";
import EditProfile from "../components/EditProfile";
import PendingRequests from "../components/PendingRequests";
import ActiveRequests from "../components/ActiveRequests";
import Block from "../components/Block";
import Search from "../components/Search";
import Notifications from "../components/Notifications";
import Mail from "../components/Mail";

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/home',
            component: Home,
            name: 'home'
        },
        {
            path: '/user/:id',
            component: Profile,
            name: 'profile'
        },
        {
            path: '/profile/me',
            component: MyProfile,
            name: 'myprofile'
        },
        {
            path: '/interests',
            component: Interests,
            name: 'interests',
        },
        {
            path: '/profile/complete',
            component: Complete,
            name: 'complete'
        },
        {
            path: '/profile/activate',
            component: Activate,
            name: 'activate'
        },
        {
            path: '/chat',
            component: Chat,
            name: 'chat'
        },
        {
            path: '/profile/edit',
            component: EditProfile,
            name: 'editProfile'
        },
        {
            path: '/pending-requests',
            component: PendingRequests,
            name: 'pendingRequests'
        },
        {
            path: '/active-requests',
            component: ActiveRequests,
            name: 'activeRequests'
        },
        {
            path: '/block-area',
            component: Block,
            name: 'blockArea'
        },
        {
            path: '/search',
            component: Search,
            name: 'search'
        },
        {
            path: '/notifications',
            component: Notifications,
            name: 'notifications'
        },
        {
            path: '/mail',
            component: Mail,
            name: 'mail'
        },
    ]
});
export default routes;
