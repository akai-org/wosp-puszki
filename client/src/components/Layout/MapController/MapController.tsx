import s from './MapController.module.less';
import { ReactComponent as MapVertical } from '@assets/map_vertical.svg';
import { FC, useEffect, useRef } from 'react';
import { volunteerStatusClass } from '@/utils';

interface Props {
  stations: Record<number, volunteerStatusClass>;
}

export const MapController: FC<Props> = ({ stations }) => {
  const containerRef = useRef<HTMLDivElement>(null);

  const changeVolunteerAvailability = (
    stationNumber: number,
    newStatus: volunteerStatusClass,
  ) => {
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.add(newStatus);
  };

  useEffect(() => {
    for (const stationsKey in stations) {
      changeVolunteerAvailability(parseInt(stationsKey), stations[stationsKey]);
    }
  }, [stations]);

  return (
    <div className={s.mapWrapper} ref={containerRef}>
      <MapVertical id="vertical-map" className={s.svgMap} />
    </div>
  );
};
