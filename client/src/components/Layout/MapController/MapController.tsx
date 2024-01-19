import s from './MapController.module.less';
import { ReactComponent as MapVertical } from '@assets/map_vertical.svg';
import { useEffect, useRef } from 'react';
import { stationState, useStationsQuery, volunteerStatusClass } from '@/utils';

export const MapController = () => {
  const { data } = useStationsQuery();
  const containerRef = useRef<HTMLDivElement>(null);

  const changeVolunteerAvailability = (stationNumber: number, newStatusId: number) => {
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.remove('volunteer-occupied');
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.remove('volunteer-available');
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.remove('volunteer-unavailable');
    containerRef.current
      ?.querySelector(`#station${stationNumber}`)
      ?.classList.add(handleNewStatus(newStatusId));
  };

  useEffect(() => {
    data.forEach((station) =>
      changeVolunteerAvailability(station.station, station.status),
    );
  }, [data]);

  return (
    <div className={s.mapWrapper} ref={containerRef}>
      <MapVertical id="vertical-map" className={s.svgMap} />
    </div>
  );
};

function handleNewStatus(statusId: number): volunteerStatusClass {
  switch (statusId) {
    case stationState.unavailable:
      return 'volunteer-unavailable';
    case stationState.available:
      return 'volunteer-available';
    case stationState.occupied:
      return 'volunteer-occupied';
    default:
      return 'volunteer-unavailable';
  }
}
