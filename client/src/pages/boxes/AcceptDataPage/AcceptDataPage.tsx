import { AcceptDataCard } from '@/components/AcceptDataCard/AcceptDataCard';
import s from './AcceptDataPage.module.less';
import { Space } from 'antd';
import { useBoxContext } from '@/utils';
import { useNavigate } from 'react-router-dom';

export const AcceptDataPage = () => {
  const navigate = useNavigate();
  const { collectorName, collectorIdentifier, boxIdentifier } = useBoxContext();

  if (!collectorName && !collectorIdentifier && !boxIdentifier)
    navigate('/liczymy/boxes/settle');

  const onAccept = () => {
    console.log('Zaakceptowano dane');
    // Dodać przenoszenie na następną stronę
  };

  return (
    <Space className={s.AcceptDataPage}>
      {collectorName && collectorIdentifier && boxIdentifier && (
        <AcceptDataCard
          id_box={boxIdentifier}
          volunteer={collectorName}
          id_number={collectorIdentifier}
          onAccept={onAccept}
        />
      )}
    </Space>
  );
};
