import { Typography, Space } from 'antd';
import s from './Main.module.css';
const { Title } = Typography;

interface Collected {
  pln: number;
  total: number;
}

export const Collected: React.FC<Collected> = ({ pln, total }) => {
  return (
    <Space direction="vertical" size={40} className={s.collected}>
      <Space direction="vertical" size={10} align="center">
        <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
          Zebralismy:
        </Title>
        <Title
          data-testid="collected-pln-test-id"
          level={2}
          style={{ margin: 0, fontWeight: 400 }}
        >
          {pln} zł
        </Title>
      </Space>
      <Space direction="vertical" size={10} align="center">
        <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
          Razem z walutami obcymi:
        </Title>
        <Title
          data-testid="collected-total-test-id"
          level={2}
          style={{ margin: 0, fontWeight: 400 }}
        >
          {total} zł
        </Title>
      </Space>
    </Space>
  );
};
