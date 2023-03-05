import { AcceptDataCard } from '@/components';
import s from './AcceptDataPage.module.less';
import { Space } from 'antd';
import {
  APIManager,
  fetcher,
  isFailedFetched,
  useBoxContext,
  setStationUnavailable,
  openNotification,
  NO_CONNECT_WITH_SERVER,
  isBoxExists,
  SETTLE_PROCESS_PATH,
  createFullRoutePath,
  DEPOSIT_BOX_PAGE_ROUTE,
} from '@/utils';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';

export const AcceptDataPage = () => {
  const navigate = useNavigate();
  const { collectorName, collectorIdentifier, boxIdentifier } = useBoxContext();

  // if we dont have information about the box, then go back to the start of the settle process
  if (!isBoxExists(collectorName, collectorIdentifier, boxIdentifier)) {
    navigate(SETTLE_PROCESS_PATH);
  }

  setStationUnavailable();

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/startCounting`, {
        method: 'POST',
      }),
    onSuccess: () => {
      navigate(createFullRoutePath(SETTLE_PROCESS_PATH, DEPOSIT_BOX_PAGE_ROUTE));
    },
    onError: (error) => {
      if (isFailedFetched(error)) openNotification('error', NO_CONNECT_WITH_SERVER);
    },
  });

  const onAccept = () => {
    mutation.mutate();
  };

  return (
    <Space className={s.AcceptDataPage}>
      {collectorName && collectorIdentifier && boxIdentifier && (
        <AcceptDataCard
          id_box={boxIdentifier}
          volunteer={collectorName}
          id_number={collectorIdentifier}
          onAccept={onAccept}
          isLoading={mutation.isLoading}
        />
      )}
    </Space>
  );
};
