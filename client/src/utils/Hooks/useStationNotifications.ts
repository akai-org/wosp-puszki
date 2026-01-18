import { useEffect, useRef } from 'react';
import { useAuthContext, getIDfromUsername, openNotification } from '@/utils';
import { useMovementControllerStations } from '@/pages/MovementControllerPage/hooks/useMovementControllerStations';

export const useStationNotifications = () => {
  const { username } = useAuthContext();
  const { data: stations } = useMovementControllerStations();
  const previousStatusRef = useRef<number | null>(null);

  useEffect(() => {
    if (!username || !stations) return;

    const isStationUser = username.toLowerCase().startsWith('wosp');
    if (!isStationUser) return;

    const stationNumber = getIDfromUsername(username);
    const myStation = stations.find((s) => s.station === stationNumber);

    if (!myStation) return;

    if (
      previousStatusRef.current !== null &&
      previousStatusRef.current !== 3 &&
      myStation.status === 3
    ) {
      openNotification(
        'info',
        'Ktoś idzie do Twojego stanowiska!',
        'Kontroler ruchu wysłał wolontariusza w Twoją stronę. Przygotuj się do odbioru puszki.',
        'station-approaching-notification',
      );
    }

    previousStatusRef.current = myStation.status;
  }, [username, stations]);
};
