import s from './DisplayPage.module.less';
import { Space } from 'antd';

export const DisplayPage = () => {
  return (
    <Space className={s.wrapper}>
      <Space className={s.moneyContainer}>test</Space>
      <Space className={s.moneyContainer}>test2</Space>
    </Space>
  );
};
