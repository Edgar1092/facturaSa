import { RouteInfo } from './sidebar.metadata';

export const ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  }
];

export const ADMIN_ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },
  {
    path: '/admin/',
    title: 'Admin',
    icon: 'ft-settings',
    isExternalLink: false,
    class: 'has-sub',
    badge: '',
    badgeClass: '',
    submenu: [
      {
        path: '/users/',
        title: 'Usuarios',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/users/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/users/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
      {
        path: '/clientes/',
        title: 'Clientes',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/clientes/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/clientes/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
      {
        path: '/productos/',
        title: 'Productos',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/productos/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/productos/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
      {
        path: '/proveedor/',
        title: 'Proveedores',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/proveedor/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/proveedor/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
      {
        path: '/inventario/',
        title: 'Inventario',
        icon: 'ft-user',
        isExternalLink: false,
        class: 'has-sub',
        badge: '',
        badgeClass: '',
        submenu: [
          {
            path: '/admin/inventario/list',
            title: 'Lista',
            icon: 'ft-list',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          },
          {
            path: '/admin/inventario/add',
            title: 'Agregar',
            icon: 'ft-user-plus',
            isExternalLink: false,
            class: '',
            badge: '',
            badgeClass: '',
            submenu: []
          }
        ]
      },
    ]
  },

];

export const CLIENTE_ROUTES: RouteInfo[] = [
  {
    path: '/home',
    title: 'Home',
    icon: 'ft-home',
    class: '',
    badge: '',
    badgeClass: '',
    isExternalLink: false,
    submenu: []
  },

];
