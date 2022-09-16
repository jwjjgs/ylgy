import React, { memo } from 'react';
import { Form, Input, Button } from 'antd-mobile';
import request from '@/utils/request';
import { useRequest } from 'ahooks';
import { history } from 'umi';
const index = memo(() => {
  const { run, loading } = useRequest(
    (data) =>
      request({
        method: 'post',
        url: '/login',
        data,
      }),
    {
      manual: true,
      onSuccess: () => {
        history.push('/');
      },
    }
  );

  return (
    <>
      <Form
        layout='horizontal'
        mode='card'
        footer={
          <Button
            block
            type='submit'
            color='primary'
            size='large'
            loading={loading}
          >
            提交
          </Button>
        }
        onFinish={run}
      >
        <Form.Header>登录</Form.Header>
        <Form.Item
          name='uid'
          label='UID'
          rules={[{ required: true, message: 'UID不能为空' }]}
        >
          <Input />
        </Form.Item>
      </Form>
      <p style={{ color: 'red' }}>
        仅供学习交流
        <br />
        不得用于商业或者其他非法用途,否则一切后果请用户自负
      </p>
    </>
  );
});

export default index;
