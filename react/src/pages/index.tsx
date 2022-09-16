import React, { memo, useEffect, useState } from 'react';
import { Card, DotLoading, Button, AutoCenter, Avatar } from 'antd-mobile';
import request from '@/utils/request';
import moment from 'moment';
import { useRequest } from 'ahooks';
import { history } from 'umi';

const index = memo(() => {
  const [user, setUser] = useState<any>(null);

  const {
    run: run_info,
    loading: loading_info,
    refresh,
  } = useRequest(
    () =>
      request({
        url: '/user/info',
        method: 'get',
      }),
    {
      manual: true,
      onSuccess: (e) => {
        setUser({ ...e });
      },
    }
  );

  const { run: run_run, loading: loading_run } = useRequest(
    () =>
      request({
        method: 'get',
        url: '/game/run',
      }),
    {
      manual: true,
      onSuccess: () => {
        refresh();
      },
    }
  );
  useEffect(() => {
    run_info();
  }, []);

  if (loading_info)
    return (
      <AutoCenter>
        <DotLoading />
      </AutoCenter>
    );
  if (!user)
    return (
      <AutoCenter>
        <Button block color='primary' onClick={run_info}>
          重试
        </Button>
      </AutoCenter>
    );
  return (
    <>
      <Card title='我的信息'>
        <AutoCenter>
          <Avatar src={user?.avatar} />
        </AutoCenter>
        <p>微信昵称：{user?.nick_name}</p>
        <p>UID：{user?.uid}</p>
        <p>
          注册时间：
          {moment.unix(user?.register_time).format('YYYY/MM/DD HH:mm:ss')}
        </p>
        <p>累计成功：{user?.challenge}次</p>
        <p>话题通关：{user?.topic_count}次</p>
        <p>
          今日状态：
          {user?.today_state === 1
            ? `已于${moment
                .unix(user?.today_ts)
                .format('YYYY/MM/DD HH:mm:ss')}通关,耗时${user?.today_time}秒`
            : '未通关'}
        </p>
        <Button block color='primary' onClick={run_run} loading={loading_run}>
          + 1
        </Button>
      </Card>
      <AutoCenter style={{ marginTop: '32px' }}>
        <Button
          fill='none'
          onClick={() => {
            history.push('/login');
          }}
        >
          切换账号
        </Button>
      </AutoCenter>
    </>
  );
});

export default index;
