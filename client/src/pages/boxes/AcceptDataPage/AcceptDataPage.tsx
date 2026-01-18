import { AcceptDataCard } from '@/components';
import s from './AcceptDataPage.module.less';
import { Space, Typography } from 'antd';
import {
  APIManager,
  createFullRoutePath,
  DEPOSIT_BOX_PAGE_ROUTE,
  fetcher,
  getIsBoxAlreadySettlingError,
  isFailedFetched,
  NO_CONNECT_WITH_SERVER,
  openNotification,
  SETTLE_PROCESS_PATH,
  useGetBoxData,
  useSetStationUnavailable,
} from '@/utils';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { useState } from 'react';

export const AcceptDataPage = () => {
  const navigate = useNavigate();
  const [settlingErrorMessage, setSettlingErrorMessage] = useState<string | undefined>(
    undefined,
  );
  const { collectorName, collectorIdentifier, boxIdentifier, isBoxSpecial } =
    useGetBoxData();
  useSetStationUnavailable();

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/charityBoxes/${boxIdentifier}/startCounting`, {
        method: 'POST',
      }),
    onSuccess: () => {
      navigate(createFullRoutePath(SETTLE_PROCESS_PATH, DEPOSIT_BOX_PAGE_ROUTE));
    },
    onError: (error) => {
      const settlingError = getIsBoxAlreadySettlingError(error);
      if (settlingError) {
        setSettlingErrorMessage(settlingError);
      }
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
      else {
        setSettlingErrorMessage('Nieznany błąd');
      }
    },
  });

  const onAccept = () => {
    setSettlingErrorMessage(undefined);
    mutation.mutate();
  };

  const errors = <>{settlingErrorMessage && settlingErrorMessage}</>;

  return (
    <Space className={s.AcceptDataPage}>
      <AcceptDataCard
        id_box={boxIdentifier}
        volunteer={collectorName}
        id_number={collectorIdentifier}
        onAccept={onAccept}
        isLoading={mutation.isLoading}
        error={errors}
        boxSpecialPrompt={
          <Typography.Text
            className={[s.errorText, isBoxSpecial ? s.visible : s.hidden].join(' ')}
          >
            Puszka została oznaczona jako specjalna. Prosimy o{' '}
            <span className={s.boldText}>DYSKRETNE</span> zawołanie szefa sztabu,
            koordynatora rozliczenia albo wolontariuszy, przed przejściem dalej
          </Typography.Text>
        }
      />
    </Space>
  );
};
