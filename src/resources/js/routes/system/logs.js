import { Index } from './logs/index';
import { Show } from './logs/show';

export const Logs = {
    path: 'logs',
    component: require('../../components/enso/layout/Router.vue'),
    meta: {
        breadcrumb: 'logs',
        route: 'system.logs.index',
    },
    children: [ Index, Show ]
};