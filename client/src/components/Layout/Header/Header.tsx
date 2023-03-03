import { Typography } from 'antd';
import { FC } from 'react';
import s from './Header.module.less';
const { Title } = Typography;

interface Props {
  title: string;
}

export const Header: FC<Props> = ({ title }) => {
  return (
    <Title level={4} className={s.title}>
      {title}
    </Title>
  );
};
