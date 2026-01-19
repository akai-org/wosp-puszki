import { Card, Divider, Space } from 'antd';
import Title from 'antd/lib/typography/Title';
import { FC, ReactNode } from 'react';
import s from './StationsSection.module.less';

interface Props {
  title: string;
  children: ReactNode;
}
export const StationsSection: FC<Props> = ({ title, children }) => {
  return (
    <Card className={s.card}>
      <Title level={4} className={s.title}>
        {title}
      </Title>
      <Divider className={s.divider} />
      <Space wrap size={[12, 12]}>
        {children}
      </Space>
    </Card>
  );
};
