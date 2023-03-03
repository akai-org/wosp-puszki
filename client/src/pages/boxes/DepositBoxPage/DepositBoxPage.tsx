import { Space } from 'antd';
import s from './DepositBoxPage.module.less';
import { DepositBoxForm } from '@/components';

export const DepositBoxPage = () => {
  return (
    <Space className={s.DepositBoxPage}>
      <DepositBoxForm />
    </Space>
  );
};
