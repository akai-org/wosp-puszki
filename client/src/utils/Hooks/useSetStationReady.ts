import { useMutation, useQueryClient } from '@tanstack/react-query';
import { APIManager, fetcher } from '@/utils';

export const useSetStationReady = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (stationNumber: number) =>
      fetcher(APIManager.setStationReadyURL(stationNumber), {
        method: 'POST',
      }),
    onSuccess: (_data, stationNumber) => {
      queryClient.invalidateQueries({ queryKey: ['movement-controller-stations'] });
      queryClient.refetchQueries({ queryKey: ['movement-controller-stations'] });

      const event = new CustomEvent('stationReady', {
        detail: { stationNumber },
      });
      window.dispatchEvent(event);
    },
    onError: (error) => {
      console.error('Failed to set station ready_deployed:', error);
    },
  });
};
