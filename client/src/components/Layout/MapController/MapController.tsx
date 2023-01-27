import s from './MapController.module.less';
import { ReactComponent as MapVertical } from '@assets/map_vertical.svg';
import { useEffect, useRef } from 'react';
import { useStationsQuery, volunteerStatusClass } from '@/utils';

export const MapController = () => {
  const { data } = useStationsQuery();
  const containerRef = useRef<HTMLDivElement>(null);

  const changeVolunteerAvailability = (stationNumber: number, newStatusId: number) => {
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.add(handleNewStatus(newStatusId));
  };

  useEffect(() => {
    data.forEach((station) => changeVolunteerAvailability(station.s, station.st));
  }, [data]);

  return (
    <div className={s.mapWrapper} ref={containerRef}>
      <MapVertical id="vertical-map" className={s.svgMap} />
    </div>
  );
};

function handleNewStatus(statusId: number): volunteerStatusClass {
  switch (statusId) {
    case 0:
      return 'volunteer-unavailable';
    case 1:
      return 'volunteer-available';
    case 2:
      return 'volunteer-occupied';
    default:
      return 'volunteer-unavailable';
  }
}
