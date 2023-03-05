import { Layout, Button, Space } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';
import { useNavigate } from 'react-router-dom';
import { useAmountsQuery, useAuthContext } from '@/utils';

const { Content } = Layout;

export const Main = () => {
  const navigate = useNavigate();
  const { data: amountsData } = useAmountsQuery();
  const { username } = useAuthContext();

  // TODO: Change buttons to links
  return (
    <Content className={s.container}>
      <Collected pln={amountsData.amount_PLN} total={amountsData.amount_total_in_PLN} />
      <Space size={30}>
        {username && username?.slice(0, 4) == 'wosp' ? null : (
          <Button onClick={() => navigate('boxes')} type="primary" className={s.buttons}>
            Wydaj puszkę wolontariuszowi
          </Button>
        )}
        <Button
          onClick={() => {
            navigate('boxes/settle');
          }}
          className={s.buttons}
        >
          Rozlicz puszkę
        </Button>
      </Space>
    </Content>
  );
};
