import { DepositBoxForm } from '@/components';
import { Modal } from '@/components/Modal/Modal';
import {
  AMOUNTS_KEYS,
  BoxData,
  DepositContext,
  useDepositContextValues,
  useGetBoxQuery,
} from '@/utils';
import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

export const EditBoxPage = () => {
  const { id } = useParams();
  const queryData = useGetBoxQuery(id as string).data;
  const [data, setData] = useState<BoxData | null>(null);
  const [canShow, setCanShow] = useState(false);

  // Not elegant, but working
  useEffect(() => {
    if (canShow) return;
    setTimeout(() => {
      setCanShow(true);
    }, 100);
  }, [canShow]);

  useEffect(() => {
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    const amounts: any = {};

    if (queryData) {
      Array.from(AMOUNTS_KEYS).forEach((key) => {
        amounts[key] = queryData[key];
      });
    }

    setData(
      queryData
        ? {
            amounts,
            comment: queryData?.comment || '',
            additional_comment: queryData?.additional_comment || ''
          }
        : null,
    );

    return () => {
      setData(null);
    };
  }, [queryData]);

  return (
    <Modal title="Modyfikuj zawartość puszki">
      <div>{data && canShow && <EditBoxForm id={id as string} data={data} />}</div>
    </Modal>
  );
};

const EditBoxForm = ({ id, data }: { id: string; data: BoxData | null }) => {
  const depositValues = useDepositContextValues(data);

  return (
    <DepositContext.Provider value={depositValues}>
      <DepositBoxForm editMode boxId={id} />
    </DepositContext.Provider>
  );
};
