import { AcceptDataCard } from '@/components/AcceptDataCard/AcceptDataCard';
import { useState } from 'react';
import s from './AcceptDataPage.module.less';
import { Space } from 'antd';

export const AcceptDataPage = () => {
  const [data] = useState({
    id_box: 22,
    volunteer: 'Pan Paweł',
    id_number: 123,
    type: 'box' as 'box' | 'case',
  });

  const onAccept = () => {
    console.log('Zaakceptowano dane');
  };

  return (
    <Space className={s.AcceptDataPage}>
      <AcceptDataCard
        id_box={data.id_box}
        volunteer={data.volunteer}
        id_number={data.id_number}
        type={data.type}
        onAccept={onAccept}
      />
    </Space>
  );
};
