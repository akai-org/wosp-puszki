import { Space } from 'antd';
import s from './DepositBoxPage.module.less';
import { DepositBoxForm } from '@/components';
import { setStationUnavailable, useGetBoxData } from '@/utils';
import { Content } from 'antd/lib/layout/layout';
import Title from 'antd/lib/typography/Title';

export const DepositBoxPage = () => {

  const { boxIdentifier, collectorName, collectorIdentifier } = useGetBoxData();

  setStationUnavailable();

  return (
    <Space className={s.DepositBoxPage}>
      <Content className={s.full}>
        <Title level={4} className={s.title}>
          Rozliczenie puszki wolontariusza {collectorName} ( {collectorIdentifier} ) ( ID
          puszki w bazie:
          {boxIdentifier} )
        </Title>
        <DepositBoxForm />
      </Content>
    </Space>
  );
};
