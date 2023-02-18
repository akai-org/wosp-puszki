import {
  APIManager,
  MONEY_VALUES,
  NO_CONNECT_WITH_SERVER,
  ZLOTY_AMOUNTS_KEYS,
  fetcher,
  isFailedFetched,
  openNotification,
  setStationUnavailable,
  sum,
  useBoxContext,
} from '@/utils';
import { useDepositContext } from '@/utils/Contexts/DepositContext';
import { useMutation } from '@tanstack/react-query';
import { Button, Space, Typography } from 'antd';
import { useNavigate } from 'react-router-dom';
import s from './SettleBoxPageCheckout.module.less';

import { Header } from '@/components/Layout/Header/Header';
import { ContentColumns } from '@/components/boxes/SettleBoxCheckout/ContentColumns';
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
  const { isBoxExists, deleteBox, boxIdentifier, collectorIdentifier } = useBoxContext();

  // if we dont have information about the box, then go back to the start of the settle process
  if (!isBoxExists()) {
    navigate('/liczymy/boxes/settle');
  }

  // set station status to unavailable
  setStationUnavailable();

  // when we get data, calculate the total value
  useEffect(() => {
    setTotal(sum(boxData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES));
  }, [boxData]);

  // POST data to server
  const confirmMutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/finishCounting`, {
        method: 'POST',
      }),
    // on success clean context and return to the start of the settle process
    onSuccess: () => {
      deleteBox();
      cleanAmounts();
      navigate('/liczymy/boxes/settle');
    },
    // if we get error about failed fetching, open the notification about that
    onError: (error) => {
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
    },
  });

  // go to the previous page
  const goBackToDeposit = () => {
    navigate(-1);
  };

  // submit whole process, send data to server
  const confirmData = () => {
    confirmMutation.mutate();
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
          className={s.confirm}
          onClick={confirmData}
          disabled={confirmMutation.isLoading}
        >
          {confirmMutation.isLoading ? <Spinner /> : 'Potwierdź rozliczenie puszki'}
        </Button>
        <Button
          className={s.goBack}
          disabled={confirmMutation.isLoading}
          onClick={goBackToDeposit}
        >
          Wróć do poprzedniej strony
        </Button>
      </Space>
    </Content>
  );
};
