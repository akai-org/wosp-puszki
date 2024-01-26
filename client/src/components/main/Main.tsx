import { Layout, Button, Space, Typography } from 'antd';
import { Collected } from './Collected';
import s from './Main.module.css';
import { useNavigate } from 'react-router-dom';
import {
  BOXES_PATH,
  SETTLE_PROCESS_PATH,
  useAmountsQuery,
  useAuthContext,
} from '@/utils';
import { COLLECTED_AUCTION_ID, COLLECTED_ESKARBONKA_ID, COLLECTED_TOTAL_ID } from '@tests/utils/testIDs';

const { Content } = Layout;
const { Title } = Typography;
const auction = false;

export const Main = () => {
  const navigate = useNavigate();
  const { data: amountsData } = useAmountsQuery();
  const { username } = useAuthContext();

  // TODO: Change buttons to links
  return (
    <Content className={s.container}>
      {!auction && <Collected piggy={amountsData.amount_PLN_eskarbonka} total={amountsData.amount_total_in_PLN}/>}

      {auction && <Space direction="vertical" size={10} align="center">
        <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
          Zebraliśmy z puszek:
        </Title>
        <Title
          data-testid={COLLECTED_TOTAL_ID}
          level={2}
          style={{ margin: 0, fontWeight: 400 }}
        >
          {amountsData.amount_total_in_PLN} zł
        </Title>
      </Space>}
      <Space size={30}>
        <Space direction="vertical" size={30} align="center">
          {auction && <Space direction="vertical" size={10} align="center">
            <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
              Zebraliśmy w eSkarbonce:
            </Title>
            <Title
              data-testid={COLLECTED_ESKARBONKA_ID}
              level={2}
              style={{ margin: 0, fontWeight: 400 }}
            >
              {amountsData.amount_PLN_eskarbonka} zł
            </Title>
          </Space>}
          {username && username?.slice(0, 4) == 'wosp' ? null : (
            <Button
              onClick={() => navigate(BOXES_PATH)}
              type="primary"
              className={s.buttons}
            >
              Wydaj puszkę wolontariuszowi
            </Button>
          )}
        </Space>
        <Space direction="vertical" size={30} align="center">
          {auction && <Space direction="vertical" size={10} align="center">
            <Title level={2} style={{ margin: 0, fontWeight: 400 }}>
              Zebraliśmy z Aukcji:
            </Title>
            <Title
              data-testid={COLLECTED_AUCTION_ID}
              level={2}
              style={{ margin: 0, fontWeight: 400 }}
            >
              {0} zł
            </Title>
          </Space>}
          <Button
            onClick={() => {
              navigate(SETTLE_PROCESS_PATH);
            }}
            className={s.buttons}
          >
            Rozlicz puszkę
          </Button>
        </Space>
      </Space>
    </Content>
  );
};
