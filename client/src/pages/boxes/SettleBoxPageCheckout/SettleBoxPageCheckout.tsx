import {
  MONEY_VALUES,
  NO_CONNECT_WITH_SERVER,
  ZLOTY_AMOUNTS_KEYS,
  isFailedFetched,
  openNotification,
  setStationUnavailable,
  sum,
  useBoxContext,
  useDepositContext,
  isBoxExists,
  useFinishCounting,
} from '@/utils';
import { Button, Space, Typography } from 'antd';
import { useNavigate } from 'react-router-dom';
import s from './SettleBoxPageCheckout.module.less';

import { Header } from '@/components/Layout/Header/Header';
import { ContentColumns } from '@/components/boxes/SettleBoxCheckout/ContentColumns/ContentColumns';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { Content } from 'antd/lib/layout/layout';
import { useEffect, useState } from 'react';
const { Text } = Typography;

export const SettleBoxPageCheckout = () => {
  const navigate = useNavigate();

  // state for sum of values
  const [total, setTotal] = useState(0);

  // get data and functions from contexts
  const { boxData, cleanAmounts } = useDepositContext();
  const { deleteBox, boxIdentifier, collectorIdentifier, collectorName } =
    useBoxContext();

  const { error, isError, isLoading, isSuccess, mutateAsync } =
    useFinishCounting(boxIdentifier);

  // if we dont have information about the box, then go back to the start of the settle process
  if (!isBoxExists(collectorName, collectorIdentifier, boxIdentifier)) {
    navigate('/liczymy/boxes/settle');
  }

  // set station status to unavailable
  setStationUnavailable();

  // when we get data, calculate the total value
  useEffect(() => {
    setTotal(sum(boxData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES));
  }, [boxData]);

  // react to the behavior of the useFinishCounting hook
  useEffect(() => {
    if (isError) {
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
    }
    if (isSuccess) {
      deleteBox();
      cleanAmounts();
      navigate('/liczymy/boxes/settle');
    }
  }, [isError, isSuccess]);

  // go to the previous page
  const goBackToDeposit = () => {
    navigate('/liczymy/boxes/settle/3');
  };

  // submit whole process, send data to server
  const confirmData = async () => {
    await mutateAsync();
  };

  return (
    <Content className={s.pageCheckout}>
      <Header
        title={
          'Potwierdzenie rozliczenia puszki wolontariusza ' +
          collectorIdentifier +
          ' ( ID puszki w bazie: ' +
          boxIdentifier +
          ' )'
        }
      />
      <ContentColumns boxData={boxData} total={total} />
      <Space className={s.action}>
        <Text>Nie oddawaj puszki wolontariuszowi</Text>
        <Button
          data-testid="submitButton"
          className={s.confirm}
          onClick={confirmData}
          disabled={isLoading}
        >
          {isLoading ? <Spinner /> : 'Potwierdź rozliczenie puszki'}
        </Button>
        <Button
          data-testid="backButton"
          className={s.goBack}
          disabled={isLoading}
          onClick={goBackToDeposit}
        >
          Wróć do poprzedniej strony
        </Button>
      </Space>
    </Content>
  );
};
