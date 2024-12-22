import {
  MONEY_VALUES,
  NO_CONNECT_WITH_SERVER,
  ZLOTY_AMOUNTS_KEYS,
  isFailedFetched,
  openNotification,
  setStationUnavailable,
  sum,
  useDepositContext,
  useFinishCounting,
  SETTLE_PROCESS_PATH,
  createFullRoutePath,
  DEPOSIT_BOX_PAGE_ROUTE,
  useGetBoxData,
  FIND_BOX_BUSY_PAGE_ROUTE,
} from '@/utils';
import { Button, Space, Typography } from 'antd';
import { useNavigate } from 'react-router-dom';
import s from './SettleBoxPageCheckout.module.less';

import { Header } from '@/components/Layout/Header/Header';
import { ContentColumns } from '@/components/boxes/BoxData/BoxDataOverview/ContentColumns/ContentColumns';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { Content } from 'antd/lib/layout/layout';
import { useEffect, useState } from 'react';
const { Text } = Typography;

export const SettleBoxPageCheckout = () => {
  const navigate = useNavigate();

  // state for sum of values
  const [total, setTotal] = useState(0);
  const [busy, setBusy] = useState(false);

  // get data and functions from contexts
  const { boxData, cleanAmounts } = useDepositContext();
  const { collectorIdentifier, boxIdentifier, deleteBox } = useGetBoxData();

  const { error, isError, isLoading, isSuccess, mutateAsync } =
    useFinishCounting(boxIdentifier);

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
    if (isSuccess && !busy) {
      deleteBox();
      cleanAmounts();
      navigate(SETTLE_PROCESS_PATH);
    } else if (isSuccess && busy) {
      deleteBox();
      cleanAmounts();
      navigate(createFullRoutePath(SETTLE_PROCESS_PATH, FIND_BOX_BUSY_PAGE_ROUTE));
    }
  }, [cleanAmounts, deleteBox, error, isError, isSuccess, navigate, busy]);

  // go to the previous page
  const goBackToDeposit = () => {
    navigate(createFullRoutePath(SETTLE_PROCESS_PATH, DEPOSIT_BOX_PAGE_ROUTE));
  };

  // submit whole process, send data to server
  const confirmData = async () => {
    await mutateAsync();
  };

  // submit whole process, send data to server but don't mark the station as available
  const confirmDataBusy = async () => {
    setBusy(true);
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
        <Text className={s.error}>{error ? 'Napotkano nieznany błąd' : null}</Text>
        <Button
          data-testid="submitButton"
          className={s.confirm}
          onClick={confirmData}
          disabled={isLoading}
        >
          {isLoading ? <Spinner /> : 'Potwierdź rozliczenie puszki'}
        </Button>
        <Button
          data-testid="submitBusyButton"
          className={s.confirmBusy}
          onClick={confirmDataBusy}
          disabled={isLoading}
        >
          {isLoading ? <Spinner /> : 'Przelicz kolejną puszkę'}
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
