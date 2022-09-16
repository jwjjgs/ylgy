import { Toast } from 'antd-mobile';
import axios from 'axios';
import { history } from 'umi';

const instance = axios.create({
  baseURL: '/api',
});
instance.interceptors.response.use(
  (res) => {
    const { code, msg } = res.data;
    if (200 === code) return msg;
    if (100 === code) history.push('/login');
    Toast.show({
      icon: 'fail',
      content: msg || '请求错误',
    });
    return Promise.reject(msg);
  },
  (error) => {
    Toast.show({
      icon: 'fail',
      content: error.message || '请求错误',
    });
    return Promise.reject();
  }
);

export default instance;
