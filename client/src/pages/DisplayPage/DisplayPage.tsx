import s from './DisplayPage.module.less';
import { Space } from 'antd';
import { MapDisplay } from '@components/Display';
import { MoneyDisplay } from '@components/Display/MoneyDisplay/MoneyDisplay';

export const DisplayPage = () => {
  const collectedMoney = '45 823,26';

  return (
    <div className={s.wrapper}>
      <div className={s.waves}></div>
      <Space direction="horizontal" className={s.innerWrapper}>
        <MoneyDisplay collectedMoney={collectedMoney} />
        <div id="bottom-content-portal"></div>
        <MapDisplay />
      </Space>
    </div>
  );
};
