export default {
  npmClient: 'yarn',
  routes: [
    {
      path: '/',
      component: 'index',
      exact: true,
    },
    {
      path: '/login',
      component: 'login',
      exact: true,
    },
  ],
  history: {
    type: 'hash',
  },
  proxy: {
    '/api': {
      target: 'http://localhost:8000',
      changeOrigin: true,
    },
  },
  hash: true,
  title: '羊了个羊',
  scripts: [
    'var _hmt=_hmt||[];(function(){var hm=document.createElement("script");hm.src="https://hm.baidu.com/hm.js?dee2dda4a894b12f1f5c6c36822a2737";var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(hm,s)})();',
  ],
};
