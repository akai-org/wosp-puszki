import { useMutation, useQueryClient } from '@tanstack/react-query';
import { fetcher, APIManager } from '@/utils';

export const useSetStationReadyDeployed = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (stationNumber: number) =>
      fetcher(APIManager.setStationStatusURL(stationNumber, 'ready_deployed'), {
        method: 'POST',
      }),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['movement-controller-stations'] });
    },
  });
};

