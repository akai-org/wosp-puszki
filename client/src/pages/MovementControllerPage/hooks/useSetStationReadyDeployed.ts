import { useMutation, useQueryClient } from '@tanstack/react-query';
import { fetcher, APIManager } from '@/utils';

export const useSetStationReadyDeployed = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (stationNumber: number) =>
      fetcher(APIManager.setStationReadyDeployedURL(stationNumber), {
        method: 'POST',
      }),
    onSuccess: (_data, stationNumber) => {
      queryClient.invalidateQueries({ queryKey: ['movement-controller-stations'] });
      queryClient.refetchQueries({ queryKey: ['movement-controller-stations'] });

      const event = new CustomEvent('stationReadyDeployed', {
        detail: { stationNumber },
      });
      window.dispatchEvent(event);
    },
    onError: (error) => {
      console.error('Failed to set station ready_deployed:', error);
    },
  });
};
