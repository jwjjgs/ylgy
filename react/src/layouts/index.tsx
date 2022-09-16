import { NavBar } from 'antd-mobile';
import { Outlet } from 'umi';
import './index.less';

export default function Layout() {
  /* document.documentElement.setAttribute('data-prefers-color-scheme', 'dark'); */
  return (
    <div className='navs'>
      <NavBar backArrow={false}>羊了个羊</NavBar>
      <div className='contents'>
        <Outlet />
      </div>
    </div>
  );
}
