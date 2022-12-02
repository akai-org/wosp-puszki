import { Layout, Button, Space } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';

const { Content } = Layout;

export const Main = () => (
  <Layout>
    <Content className={s.container}>
      <Collected />
      <Space size={30}>
        <Button type="primary" className={s.buttons}>
          Wydaj puszkę wolontariuszowi
        </Button>
        <Button className={s.buttons}>Rozlicz puszkę</Button>
      </Space>
    </Content>
  </Layout>
);
