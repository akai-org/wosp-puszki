import { Layout } from 'antd';
import Logo from '../../../public/wosp.svg';
const { Header } = Layout;
import styles from './Sidebar.module.less';

const SidebarSmall: React.FC = () => {
  return (
    <Layout
      className={[styles.sidebar, styles.sidebarLayout, styles.sidebarLoginPage].join(
        ' ',
      )}
    >
      <Header className={[styles.sidebar, styles.sidebarHeader].join(' ')}>
        <img src={Logo} alt="WOSP Logo" />
      </Header>
    </Layout>
  );
};

export default SidebarSmall;
