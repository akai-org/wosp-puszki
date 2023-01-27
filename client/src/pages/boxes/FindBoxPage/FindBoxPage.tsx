import React from 'react';
import { Space } from 'antd';
import s from './FindBoxPage.module.less';

import { FindBoxForm } from '@/components';

export const FindBoxPage = () => {
  return (
    <Space className={s.Page} direction="vertical">
      <FindBoxForm />
    </Space>
  );
};
