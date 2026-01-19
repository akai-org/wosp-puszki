import s from '@components/stations/StationsController/StationsController.module.less';
import { stationState, useSetStationReady } from '@/utils';
import { useMovementControllerStations } from '@utils/Hooks/useMovementControllerStations';
import { useSetStationReadyDeployed } from '@utils/Hooks/useSetStationReadyDeployed';
import { Station } from '@components/stations';
import { StationsSection } from '@components/stations/StationsSection';
import { Spin } from 'antd';

export const StationsController = () => {
  const { data: stationsData, isLoading } = useMovementControllerStations(1000);
  const { mutate: setReadyDeployed } = useSetStationReadyDeployed();
  const { mutate: setReady } = useSetStationReady();

  if (stationsData === null || stationsData === undefined) {
    return null;
  }

  const availableStations = stationsData.filter(
    (station) =>
      station.status === stationState.available ||
      station.status === stationState.ready_deployed,
  );

  const occupiedStations = stationsData.filter(
    (station) => station.status === stationState.occupied,
  );

  const unavailableStations = stationsData.filter(
    (station) => station.status === stationState.unavailable,
  );

  if (isLoading) {
    return (
      <div className={s.pageContainer}>
        <Spin />
      </div>
    );
  }

  return (
    <div className={s.pageContainer}>
      <StationsSection title={'Gotowe'}>
        {availableStations.map((station) => (
          <Station
            key={station.station}
            number={station.station}
            status={station.status}
            onClick={() => {
              station.status === stationState.available
                ? setReadyDeployed(station.station)
                : setReady(station.station);
            }}
          />
        ))}
      </StationsSection>
      <StationsSection title={'Zajęte'}>
        {occupiedStations.map((station) => (
          <Station
            key={station.station}
            number={station.station}
            status={station.status}
          />
        ))}
      </StationsSection>
      <StationsSection title={'Nieaktywne'}>
        {unavailableStations.map((station) => (
          <Station
            key={station.station}
            number={station.station}
            status={station.status}
          />
        ))}
      </StationsSection>
    </div>
  );
};
