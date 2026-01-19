import React from 'react';
import { Space } from 'antd';
import s from './FindBoxPage.module.less';

import { FindBoxForm } from '@/components';
import { useIncomingVolunteerNotification } from '@/utils';

export const FindBoxPage = () => {
  useIncomingVolunteerNotification();
  return (
    <Space className={s.Page} direction="vertical">
      <FindBoxForm />
    </Space>
  );
};
