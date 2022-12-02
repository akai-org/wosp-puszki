import { Layout, Button, Typography } from 'antd';
import Sidebar from '../../components/Layout/Sidebar';

import s from './MainPage.module.css';

const { Header, Content, Footer, Sider } = Layout;
const { Title } = Typography;

const MainPage: React.FC = () => (
  <Layout>
    <Sidebar />
    <Layout>
      <Content className={s.container}>
        <Title level={2}>Zebralismy: kasa</Title>
        <Title level={2}>Razem z walutami obcymi: kasav2</Title>
        <Layout>
          <Button type="primary">Wydaj puszkę wolontariuszowi</Button>
          <Button>Rozlicz puszkę</Button>
        </Layout>
      </Content>
    </Layout>
  </Layout>
);

export default MainPage;
