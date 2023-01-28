import { Layout, Button, Space } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';
import { useNavigate } from 'react-router-dom';
import { useAmountsQuery } from '@/utils';

const { Content } = Layout;

export const Main = () => {
  const navigate = useNavigate();
  const { data: amountsData } = useAmountsQuery();
  console.log(amountsData);

  // TODO: Change buttons to links
  return (
    <Content className={s.container}>
      <Collected pln={amountsData.amount_PLN} total={amountsData.amount_total_in_PLN} />
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
