import { Layout, Button, Space } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';
import { useNavigate } from 'react-router-dom';
import {
  BOXES_PATH,
  SETTLE_PROCESS_PATH,
  useAmountsQuery,
  useAuthContext,
} from '@/utils';

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
          <Button
            onClick={() => navigate(BOXES_PATH)}
            type="primary"
            className={s.buttons}
          >
            Wydaj puszkę wolontariuszowi
          </Button>
        )}
        <Button
          onClick={() => {
            navigate(SETTLE_PROCESS_PATH);
          }}
          className={s.buttons}
        >
          Rozlicz puszkę
        </Button>
      </Space>
    </Content>
  );
};
