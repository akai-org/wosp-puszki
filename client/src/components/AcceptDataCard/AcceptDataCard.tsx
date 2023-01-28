import { Typography, Space, Button } from 'antd';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import s from './AcceptDataCard.module.less';

type AcceptData = {
  id_box: string;
  id_number: string;
  volunteer: string;
  isLoading: boolean;
  onAccept: () => void;
};

const { Text, Title } = Typography;

export const AcceptDataCard = ({
  id_box,
  id_number,
  volunteer,
  onAccept,
  isLoading,
}: AcceptData) => {
  return (
    <div className={s.AcceptDataCard}>
      <Title level={4}>Znaleziono puszkę: {id_box}</Title>
      <Space className={s.DataLabels}>
        <Space className={s.LabelTop}>
          <Text>Wolontariusz</Text>
          <Text>{volunteer}</Text>
        </Space>
        <Space className={s.Label}>
          <Text>Numer identyfikatora i na puszce</Text>
          <Text>{id_number}</Text>
        </Space>
        <Space className={s.Label}>
          <Text>ID puszki w bazie</Text>
          <Text>{id_box}</Text>
        </Space>
      </Space>
      <Space className={s.InfoSection}>
        <div className={s.InfoNote} style={{ gap: '0px' }}>
          <p>Potwierdź, że dane z puszki i identyfikatora sq zgodne z wyświetlonymi.</p>
          <p>Potwierdź, że puszka nie nosi śladów uszkodzeń.</p>
          <p>Nie oddawaj rozliczonej puszki wolontariuszowi.</p>
        </div>
        <Button type={'primary'} className={s.AcceptBtn} onClick={onAccept}>
          {isLoading ? <Spinner /> : 'Potwierdzam Zgodność z danymi rzeczywistymi'}
        </Button>
      </Space>
    </div>
  );
};
