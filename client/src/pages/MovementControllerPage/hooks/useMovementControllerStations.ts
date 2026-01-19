import { useQuery } from '@tanstack/react-query';
import { APIManager, fetcher, IStations } from '@/utils';

export const useMovementControllerStations = () => {
  return useQuery<IStations[]>({
    queryKey: ['movement-controller-stations'],
    queryFn: () => fetcher<IStations[]>(APIManager.getStationsURL),
    refetchInterval: 5000,
  });
};
