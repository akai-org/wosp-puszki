import { Layout, Typography, Space } from 'antd';
import s from './Main.module.css';

const { Title } = Typography;

export const Collected = () => (
  <Space direction="vertical" size={40} className={s.collected}>
    <Space direction="vertical" size={10} align="center">
      <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
        Zebralismy:
      </Title>
      <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
        5 263 845, 43zł
      </Title>
    </Space>
    <Space direction="vertical" size={10} align="center">
      <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
        Razem z walutami obcymi:
      </Title>
      <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
        5 263 845, 43zł
      </Title>
    </Space>
  </Space>
);
