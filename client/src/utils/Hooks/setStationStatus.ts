import { useMutation } from '@tanstack/react-query';
import {
  APIManager,
  fetcher,
  getIDfromUsername,
  useAuthContext,
  useSetStationAvailableQuery,
  useSetStationUnavailableQuery,
} from '@/utils';

export function useSetStationAvailable() {
  const { username } = useAuthContext();
  useSetStationAvailableQuery(username);
}

export function useSetStationUnavailable() {
  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);
}

export function useSetStationUnknown(username: string) {
  const id = getIDfromUsername(username);

  const { error, isError, isLoading, isSuccess, mutateAsync } = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/unknown`, {
        method: 'POST',
      }),
  });
  return { error, isError, isLoading, isSuccess, mutateAsync };
}
