import { AcceptDataCard } from '@/components/AcceptDataCard/AcceptDataCard';
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
} from '@/utils';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';

export const AcceptDataPage = () => {
  const navigate = useNavigate();
  const { collectorName, collectorIdentifier, boxIdentifier, isBoxExists } =
    useBoxContext();

  if (!isBoxExists()) {
    navigate('/liczymy/boxes/settle');
  }

  setStationUnavailable();

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/startCounting`, {
        method: 'POST',
      }),
    onSuccess: () => {
      navigate('/liczymy/boxes/settle/3');
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
