import { ContentColumns, FormButton } from '@/components';
import { Modal } from '@/components/Modal/Modal';
import {
  AMOUNTS_KEYS,
  APIManager,
  BoxData,
  CANNOT_DOWNLOAD_DATA,
  COUNTED_BOXES_PATH,
  fetcher,
  NO_CONNECT_WITH_SERVER,
  openNotification,
  useGetBoxQuery,
  useUnverifiedBoxesQuery,
} from '@/utils';
import { Space, Spin } from 'antd';
import { Link, useNavigate, useParams } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { Content } from 'antd/lib/layout/layout';
import { FC, useEffect, useState } from 'react';
import Paragraph from 'antd/lib/typography/Paragraph';

interface Props {
  displayOnly?: boolean;
}

export const ShowBoxPage: FC<Props> = ({ displayOnly = false }) => {
  const { id } = useParams();
  const navigate = useNavigate();
  const { refetch } = useUnverifiedBoxesQuery();
  const query = useGetBoxQuery(id as string);
  const queryData = query.data;
  const isQueryLoading = query.isLoading;

  const processedData: () => BoxData | null = () => {
    if (!queryData) {
      return null;
    }

    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const amounts: any = {};

    if (queryData) {
      Array.from(AMOUNTS_KEYS).forEach((key) => {
        const val = queryData[key];
        if (typeof val === 'string') {
          amounts[key] = parseFloat(val);
        } else {
          amounts[key] = val;
        }
      });
    }

    return {
      amounts,
      comment: queryData?.comment || '',
      additional_comment: queryData?.additional_comment || '',
    };
  };

  const data = processedData();
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

  const modalContent =
    isQueryLoading || !data ? (
      <Content
        style={{
          minWidth: '50vw',
          minHeight: '50vh',
          display: 'flex',
          justifyContent: 'center',
          alignItems: 'center',
          justifyItems: 'center',
        }}
      >
        <Spin />
      </Content>
    ) : (
      <Space direction="vertical">
        <div>
          <Paragraph style={{ fontWeight: 'bold', marginBottom: 0 }}>
            Puszka przeliczona przez:
          </Paragraph>
          <Paragraph style={{ marginBottom: 0 }}>
            {queryData?.first_counted_by_name} ({queryData?.first_counted_by_phone}){' '}
            <br />
            {queryData?.second_counted_by_name} ({queryData?.second_counted_by_phone})
          </Paragraph>
        </div>
        {queryData?.collector && (
          <div style={{ fontSize: '16px', marginBottom: '20px' }}>
            <strong>Wolontariusz: </strong> {queryData.collector.firstName}{' '}
            {queryData.collector.lastName}
            <br />
            <strong>Kontakt: </strong> {queryData.collector.phoneNumber || 'Brak numeru'}
          </div>
        )}
        {data ? (
          <ContentColumns
            boxData={data}
            total={parseFloat((queryData?.amount_PLN as string) || '0')}
          />
        ) : null}
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
    );
  return (
    <Modal title={'Zawartość puszki'} key={id}>
      {modalContent}
    </Modal>
  );
};
