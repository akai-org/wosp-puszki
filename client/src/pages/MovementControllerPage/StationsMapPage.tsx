import { useState, useEffect, useRef } from 'react';
import { ReactComponent as MapVertical } from '@assets/map_vertical.svg';
import s from './StationsMapPage.module.less';
import { stationState } from '@/utils';
import { useMovementControllerStations } from './hooks/useMovementControllerStations';
import { useSetStationReadyDeployed } from './hooks/useSetStationReadyDeployed';
import { Button } from 'antd';
import { CheckOutlined, CloseOutlined } from '@ant-design/icons';

export const StationsMapPage = () => {
  const { data: stationsData, isLoading } = useMovementControllerStations();
  const { mutate: setReadyDeployed, isLoading: isMutating } =
    useSetStationReadyDeployed();
  const containerRef = useRef<HTMLDivElement>(null);
  const [selectedStation, setSelectedStation] = useState<number | null>(null);

  const stations = Array.isArray(stationsData) ? stationsData : [];

  useEffect(() => {
    if (!stations || stations.length === 0) return;

    stations.forEach((station) => {
      const element = containerRef.current?.querySelector(`#station${station.station}`);
      if (!element) return;

      element.classList.remove(
        'volunteer-occupied',
        'volunteer-available',
        'volunteer-ready-deployed',
        'volunteer-unavailable',
      );

      switch (station.status) {
        case stationState.available:
          element.classList.add('volunteer-available');
          break;
        case stationState.occupied:
          element.classList.add('volunteer-occupied');
          break;
        case stationState.ready_deployed:
          element.classList.add('volunteer-ready-deployed');
          break;
        default:
          element.classList.add('volunteer-unavailable');
      }
    });
  }, [stations]);

  useEffect(() => {
    if (!stations) return;

    const handleStationClick = (e: Event) => {
      const target = e.target as SVGElement;
      const stationId = target.id.replace('station', '');
      const stationNumber = parseInt(stationId);

      if (!stationNumber || isNaN(stationNumber)) return;

      const station = stations.find((s) => s.station === stationNumber);

      if (station && station.status === stationState.available) {
        setSelectedStation(stationNumber);
      }
    };

    const container = containerRef.current;

    stations.forEach((station) => {
      const element = container?.querySelector(`#station${station.station}`);
      if (!element) return;

      if (station.status === stationState.available) {
        element.addEventListener('click', handleStationClick);
        element.classList.add(s.clickable);
      } else {
        element.classList.remove(s.clickable);
      }
    });

    return () => {
      stations.forEach((station) => {
        const element = container?.querySelector(`#station${station.station}`);
        if (element) {
          element.removeEventListener('click', handleStationClick);
          element.classList.remove(s.clickable);
        }
      });
    };
  }, [stations]);

  const handleConfirm = () => {
    if (!selectedStation) return;
    setReadyDeployed(selectedStation, {
      onSuccess: () => {
        console.log('Station status changed successfully');
        setSelectedStation(null);
      },
      onError: (error) => {
        console.error('Failed to change station status:', error);
        setSelectedStation(null);
      }
    });
  };

  const handleCancel = () => {
    setSelectedStation(null);
  };

  if (isLoading) {
    return (
      <div className={s.pageContainer}>
        <div className={s.loading}>Ładowanie...</div>
      </div>
    );
  }

  return (
    <div className={s.pageContainer}>
      <div className={s.mapContainer} ref={containerRef}>
        <MapVertical id="vertical-map" />
      </div>
      {selectedStation && (
        <div className={s.bottomBar}>
          <Button
            type="primary"
            danger
            icon={<CloseOutlined />}
            onClick={handleCancel}
            size="large"
            className={s.cancelButton}
          />
          <div className={s.stationNumber}>Stanowisko {selectedStation}</div>
          <Button
            type="primary"
            icon={<CheckOutlined />}
            onClick={handleConfirm}
            size="large"
            className={s.confirmButton}
            loading={isMutating}
          />
        </div>
      )}
    </div>
  );
};
