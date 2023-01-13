import s from './DisplayPage.module.less';
import { Space } from 'antd';
import MapVertical from '@assets/map_vertical.svg';

export const DisplayPage = () => {
  return (
    <Space direction="horizontal" className={s.wrapper}>
      <section>test</section>
      <section className={s.mapContaienr}>
        <img height="100%" width="100%" src={MapVertical} alt="" />
      </section>
    </Space>
  );
};
