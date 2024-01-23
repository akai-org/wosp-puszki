import { ContentColumns, FormButton } from '@/components';
import { Modal } from '@/components/Modal/Modal';
import {
  BoxData,
  useGetBoxQuery,
  AMOUNTS_KEYS,
  fetcher,
  APIManager,
  COUNTED_BOXES_PATH,
  openNotification,
  NO_CONNECT_WITH_SERVER,
  CANNOT_DOWNLOAD_DATA,
  useUnverifiedBoxesQuery,
} from '@/utils';
import { Space } from 'antd';
import { Link, useNavigate, useParams } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { FC } from 'react';

interface Props {
  displayOnly?: boolean;
}
export const ShowBoxPage: FC<Props> = ({ displayOnly = false }) => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { refetch } = useUnverifiedBoxesQuery();

  const queryData = id ? useGetBoxQuery(id).data : undefined;

  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  const amounts: any = {};

  if (queryData) {
    Array.from(AMOUNTS_KEYS).forEach((key) => {
      amounts[key] = queryData[key];
    });
  }

  const data: BoxData = {
    amounts,
    comment: queryData?.comment || '',
  };

  const verifyMutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/charityBoxes/verified/${id}`, {
        method: 'POST',
      }),
    onSuccess: () => {
      refetch();
      navigate(`${COUNTED_BOXES_PATH}`, { relative: 'route' });
    },
    onError: () => {
      openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
    },
  });

  const unverifyMutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/charityBoxes/unverified/${id}`, {
        method: 'POST',
      }),
    onSuccess: () => {
      refetch();
      navigate(`${COUNTED_BOXES_PATH}`, { relative: 'route' });
    },
    onError: () => {
      openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
    },
  });

  const actions = queryData?.is_confirmed ? (
    <FormButton
      type="primary"
      onClick={() => unverifyMutation.mutate()}
      isLoading={unverifyMutation.isLoading}
    >
      Cofnij zatwierdzenie
    </FormButton>
  ) : (
    <FormButton
      type="primary"
      onClick={() => verifyMutation.mutate()}
      isLoading={verifyMutation.isLoading}
    >
      Zatwierdź
    </FormButton>
  );

  return (
    <Modal title={'Zawartość puszki'}>
      <Space direction="vertical">
        <ContentColumns boxData={data} total={queryData?.amount_PLN || 0} />
        <Space>
          {!queryData?.is_confirmed && !displayOnly && (
            <Link
              to={`/liczymy/countedBoxes${
                queryData?.is_confirmed ? '/approved' : ''
              }/edit/${id}`}
            >
              <FormButton type="primary">Edytuj puszkę</FormButton>
            </Link>
          )}
          {displayOnly ? null : actions}
        </Space>
      </Space>
    </Modal>
  );
};
