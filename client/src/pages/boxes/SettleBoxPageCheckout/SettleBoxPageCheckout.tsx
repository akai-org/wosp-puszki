import s from './SettleBoxPageCheckout.module.less';
import { Button, Space, Typography } from 'antd';
import { useDepositContext } from '@/utils/Contexts/DepositContext';
import { useNavigate } from 'react-router-dom';
import {
  APIManager,
  fetcher,
  useBoxContext,
  setStationUnavailable,
  MONEY_VALUES,
  ZLOTY_AMOUNTS_KEYS,
  FOREIGN_AMOUNTS_KEYS,
  isFailedFetched,
  openNotification,
  NO_CONNECT_WITH_SERVER,
  moneyValuesType,
} from '@/utils';
import { useMutation } from '@tanstack/react-query';

import { Spinner } from '@components/Layout/Spinner/Spinner';
import { Content } from 'antd/lib/layout/layout';
const { Title, Text } = Typography;

export const SettleBoxPageCheckout = () => {
  const navigate = useNavigate();

  const { boxData, zlotySum, cleanAmounts } = useDepositContext();
  const { isBoxExists, deleteBox, boxIdentifier, collectorIdentifier } = useBoxContext();

  if (!isBoxExists()) {
    navigate('/liczymy/boxes/settle');
  }

  setStationUnavailable();

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/finishCounting`, {
        method: 'POST',
      }),
    onSuccess: () => {
      deleteBox();
      cleanAmounts();
      navigate('/liczymy/boxes/settle');
    },
    onError: (error) => {
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
    },
  });

  const goBackToDeposit = () => {
    navigate(-2);
  };

  const confirmData = () => {
    mutation.mutate();
  };

  const values: string[] = Object.keys(MONEY_VALUES);

  return (
    <Content className={s.pageCheckout}>
      <Title level={4} className={s.title}>
        Potwierdzenie rozliczenia puszki {collectorIdentifier} ( ID puszki w bazie:
        {boxIdentifier} )
      </Title>
      <Space className={s.contentColumns}>
        <Space className={s.contentSection}>
          <Space className={s.contentColumn} direction="vertical">
            <Space size={60} className={s.columnNames}>
              <p>Nominał</p>
              <p>Ilość</p>
              <p>Wartość</p>
            </Space>
            {ZLOTY_AMOUNTS_KEYS.map((key, index) => (
              <Space size={60} key={key} className={s.columnLine}>
                <Text className={s.denomination}>{values[index]}</Text>
                <Text className={s.amount}>{boxData.amounts[key]}</Text>
                <Text className={s.value}>
                  {boxData.amounts[key] *
                    MONEY_VALUES[values[index] as keyof moneyValuesType]}{' '}
                  zł
                </Text>
              </Space>
            ))}
            <Space className={s.columnBottom}>
              <Text>Suma (PLN)</Text>
              <Text>{zlotySum} zł</Text>
            </Space>
          </Space>
          <Space className={s.contentColumn} direction="vertical">
            <Space size={60} className={s.columnNames}>
              <p>Nominał</p>
              <p>Ilość</p>
            </Space>
            {FOREIGN_AMOUNTS_KEYS.map((key, index) => (
              <Space size={60} key={key} className={s.columnLine}>
                <Text>{values[index + 15]}</Text>
                <Text>{boxData.amounts[key]}</Text>
              </Space>
            ))}
            <Space className={s.columnBottom}>
              <Text>Inne</Text>
              <Text>{boxData.comment}</Text>
            </Space>
          </Space>
        </Space>
        <Space className={s.sum}>
          <Title level={4}>Suma (bez walut obcych):</Title>
          <Title level={4}>{zlotySum} zł</Title>
        </Space>
      </Space>
      <Space className={s.action}>
        <Text>Nie oddawaj puszki wolontariuszowi</Text>
        <Button className={s.confirm} onClick={confirmData}>
          {mutation.isLoading ? <Spinner /> : 'Potwierdź rozliczenie puszki'}
        </Button>
        <Button
          className={s.goBack}
          disabled={mutation.isLoading}
          onClick={goBackToDeposit}
        >
          Wróć do poprzedniej strony
        </Button>
      </Space>
    </Content>
  );
};
