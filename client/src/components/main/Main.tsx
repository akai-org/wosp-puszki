import { Layout, Button, Space } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';
import { useNavigate } from 'react-router-dom';

const { Content } = Layout;

export const Main = () => {
  const navigate = useNavigate();

  // TODO: Change buttons to links
  return (
    <Content className={s.container}>
      <Collected />
      <Space size={30}>
        <Button
          onClick={() => navigate('boxes/give')}
          type="primary"
          className={s.buttons}
        >
          Wydaj puszkę wolontariuszowi
        </Button>
        <Button onClick={() => navigate('boxes/settle')} className={s.buttons}>
          Rozlicz puszkę
        </Button>
      </Space>
    </Content>
  );
};
