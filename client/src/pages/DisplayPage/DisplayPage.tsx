import s from './DisplayPage.module.less';
import { Space } from 'antd';
import { MapDisplay } from '@components/Display';
import { MoneyDisplay } from '@components/Display/MoneyDisplay/MoneyDisplay';

export const DisplayPage = () => {
  return (
    <div className={s.wrapper}>
      <Space direction="horizontal" className={s.innerWrapper}>
        <MoneyDisplay />
        <MapDisplay />
      </Space>
    </div>
  );
};
