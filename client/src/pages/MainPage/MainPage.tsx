import { Layout, Button, Typography, Space } from 'antd';
import s from './MainPage.module.css';

const { Content } = Layout;
const { Title } = Typography;

interface MoneyValues {
  collected: string;
  collectedWithForeignCurrency: string;
}

const MainPage: React.FC = () => (
    <Layout>
      <Content className={s.container}>
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
        <Space size={30}>
          <Button type="primary" className={s.buttons}>
            Wydaj puszkę wolontariuszowi
          </Button>
          <Button className={s.buttons}>Rozlicz puszkę</Button>
        </Space>
      </Content>
    </Layout>
);

export default MainPage;
