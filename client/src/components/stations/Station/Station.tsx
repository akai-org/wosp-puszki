import { FC } from 'react';
import s from './Station.module.less';
import { stationState } from '@/utils';

interface Props {
  number: number;
  status: number;
  onClick?: () => void;
}

export const Station: FC<Props> = ({ number, status, onClick = () => {} }) => {
  const getStatusClassName = () => {
    switch (status) {
      case stationState.available:
        return s.available;
      case stationState.ready_deployed:
        return s.ready_deployed;
      case stationState.occupied:
        return s.occupied;
      default:
        return '';
    }
  };

  return (
    <button className={`${s.station} ${getStatusClassName()}`} onClick={() => onClick()}>
      {number}
    </button>
  );
};
