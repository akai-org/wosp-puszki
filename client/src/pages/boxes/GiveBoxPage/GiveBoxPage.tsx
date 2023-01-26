import React from 'react';
import { Space } from 'antd';
import s from './GiveBoxPage.module.less';

import { GiveBoxForm } from '@/components';

export const GiveBoxPage = () => {
  return (
    <Space className={s.Page} direction="vertical">
      <GiveBoxForm />
    </Space>
  );
};
