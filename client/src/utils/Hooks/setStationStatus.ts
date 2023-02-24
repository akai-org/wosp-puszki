import { useMutation } from '@tanstack/react-query';
import { useAuthContext } from '../Contexts';
import { useSetStationAvailableQuery, useSetStationUnavailableQuery } from '../queries';
import { APIManager } from '../Classes';
import { fetcher } from '../fetcher';
import { getID } from '../Functions';

export function setStationAvailable() {
  const { username } = useAuthContext();
  useSetStationAvailableQuery(username);
  return 'Available';
}

export function setStationUnavailable() {
  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);
  return 'Unavailable';
}

export function setStationUnknown(username: string) {
  const id = getID(username);

  const { error, isError, isLoading, isSuccess, mutateAsync } = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/unknown`, {
        method: 'POST',
      }),
  });
  return { error, isError, isLoading, isSuccess, mutateAsync };
}
