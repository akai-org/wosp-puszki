import { Typography, Space, Button } from 'antd';
import { useAuthContext, getTopPermission, permissions } from '@/utils';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import s from './AcceptDataCard.module.less';
import { ReactNode } from 'react';

type AcceptData = {
  id_box: string;
  id_number: string;
  volunteer: string;
  isLoading: boolean;
  onAccept: () => void;
  error?: ReactNode;
  boxSpecialPrompt?: ReactNode;
};

const { Text, Title } = Typography;

export const AcceptDataCard = ({
  id_box,
  id_number,
  volunteer,
  onAccept,
  isLoading,
  error,
  boxSpecialPrompt,
}: AcceptData) => {
  const { roles } = useAuthContext();
  const topRole = getTopPermission(roles);
  const isPermitted = topRole !== null && topRole <= permissions['collectorcoordinator'];

  return (
    <div className={s.AcceptDataCard}>
      <Title level={4}>Znaleziono puszkę{isPermitted && <>: {id_box}</>}</Title>
      <Space className={s.DataLabels}>
        <Space className={s.LabelTop}>
          <Text>Wolontariusz</Text>
          <Text>{volunteer}</Text>
        </Space>
        <Space className={s.Label}>
          <Text>Numer identyfikatora i na puszce</Text>
          <Text>{id_number}</Text>
        </Space>
      </Space>
      <Space className={s.InfoSection}>
        <div className={s.InfoNote} style={{ gap: '0px' }}>
          <p>Potwierdź, że dane z puszki i identyfikatora sq zgodne z wyświetlonymi.</p>
          <p>Potwierdź, że puszka nie nosi śladów uszkodzeń.</p>
          <p>Nie oddawaj rozliczonej puszki wolontariuszowi.</p>
        </div>
        {boxSpecialPrompt}
        <Button
          type={'primary'}
          className={s.AcceptBtn}
          onClick={onAccept}
          disabled={isLoading}
        >
          {isLoading ? <Spinner /> : 'Potwierdzam Zgodność z danymi rzeczywistymi'}
        </Button>
      </Space>
      <Text className={s.errorText}>{error}</Text>
    </div>
  );
};
