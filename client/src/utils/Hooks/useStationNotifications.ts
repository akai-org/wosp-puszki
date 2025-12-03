import { useEffect } from 'react';
import { useAuthContext, getIDfromUsername, openNotification } from '@/utils';
export const useStationNotifications = () => {
  const { username } = useAuthContext();

  useEffect(() => {
    if (!username) return;

    const isStationUser = username.toLowerCase().startsWith('wosp');
    if (!isStationUser) return;

    const stationNumber = getIDfromUsername(username);

    const handleStationStatusChange = (event: Event) => {
      const customEvent = event as CustomEvent<{ stationNumber: number }>;
      const { stationNumber: changedStation } = customEvent.detail;

      if (changedStation === stationNumber) {
        openNotification(
          'info',
          'Ktoś idzie do Twojego stanowiska!',
          'Kontroler ruchu wysłał wolontariusza w Twoją stronę. Przygotuj się do odbioru puszki.',
          'station-approaching-notification',
        );
      }
    };

    window.addEventListener('stationReadyDeployed', handleStationStatusChange);
    return () => {
      window.removeEventListener('stationReadyDeployed', handleStationStatusChange);
    };
  }, [username]);
};
