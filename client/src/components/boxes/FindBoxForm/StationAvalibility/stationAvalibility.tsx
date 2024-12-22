import { Content } from 'antd/lib/layout/layout';
import { useState, useEffect } from 'react';
import s from './stationAvalibility.module.less';
import { useNavigate, useLocation } from 'react-router-dom';
import {
  SETTLE_PROCESS_PATH,
  FIND_BOX_PAGE_ROUTE,
  FIND_BOX_BUSY_PAGE_ROUTE,
} from '@/utils';
import { FormButton } from '@/components/forms';
import { Typography } from 'antd';

const { Text } = Typography;

export const StationAvalibility = () => {
  const navigate = useNavigate();
  const location = useLocation();
  const [stationAvalibilityMessage, setStationAvalibilityMessage] = useState('');

  useEffect(() => {
    if (location.pathname === `${SETTLE_PROCESS_PATH}/${FIND_BOX_PAGE_ROUTE}`) {
      setStationAvalibilityMessage('WOLNE');
    } else if (
      location.pathname === `${SETTLE_PROCESS_PATH}/${FIND_BOX_BUSY_PAGE_ROUTE}`
    ) {
      setStationAvalibilityMessage('ZAJĘTE');
    }
  }, [location.pathname]);

  const handleStationAvalibilityChange = (currentAvalibility: string) => {
    if (currentAvalibility === 'WOLNE') {
      navigate(`${SETTLE_PROCESS_PATH}/${FIND_BOX_BUSY_PAGE_ROUTE}`);
    } else if (currentAvalibility === 'ZAJĘTE') {
      navigate(`${SETTLE_PROCESS_PATH}/${FIND_BOX_PAGE_ROUTE}`);
    }
  };

  return (
    <Content className={s.container}>
      <Text className={s.header}>Dostępność stanowiska</Text>
      <Text className={stationAvalibilityMessage === 'WOLNE' ? s.go : s.busy}>
        {stationAvalibilityMessage}
      </Text>
      <FormButton
        onClick={() => {
          handleStationAvalibilityChange(stationAvalibilityMessage);
        }}
      >
        Zmień dostępność
      </FormButton>
    </Content>
  );
};
