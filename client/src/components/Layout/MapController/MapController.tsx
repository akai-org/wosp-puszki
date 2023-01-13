import s from './MapController.module.less';
import { ReactComponent as MapVertical } from '@assets/map_vertical.svg';
import { useRef } from 'react';
import { volunteerStatusClass } from '@/utils';

export const MapController = () => {
  const containerRef = useRef<HTMLDivElement>(null);

  const changeVolunteerAvailability = (
    stationNumber: number,
    newStatus: volunteerStatusClass,
  ) => {
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.add(newStatus);
  };

  return (
    <div ref={containerRef}>
      <MapVertical id="vertical-map" className={s.svgMap} />
    </div>
  );
};
