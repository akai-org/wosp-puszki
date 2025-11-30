import { useMutation, useQueryClient } from '@tanstack/react-query';
import { fetcher, APIManager } from '@/utils';

export const useSetStationReadyDeployed = () => {
  const queryClient = useQueryClient();

  return useMutation({
    mutationFn: (stationNumber: number) =>
      fetcher(APIManager.setStationReadyDeployedURL(stationNumber), {
        method: 'POST',
      }),
    onSuccess: () => {
      queryClient.invalidateQueries({ queryKey: ['movement-controller-stations'] });
      queryClient.refetchQueries({ queryKey: ['movement-controller-stations'] });
    },
    onError: (error) => {
      console.error('Failed to set station ready_deployed:', error);
    },
  });
};
