import s from './DisplayPage.module.less';
import { Space } from 'antd';
import { MapController } from '@/components/Layout/MapController/MapController';

export const DisplayPage = () => {
  return (
    <Space direction="horizontal" className={s.wrapper}>
      <section>test</section>
      <section>
        <MapController />
      </section>
    </Space>
  );
};
