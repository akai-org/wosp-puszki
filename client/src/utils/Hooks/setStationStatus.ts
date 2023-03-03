import { useMutation } from '@tanstack/react-query';
import { useAuthContext } from '../Contexts';
import { useSetStationAvailableQuery, useSetStationUnavailableQuery } from '../queries';
import { APIManager } from '../Classes';
import { fetcher } from '../fetcher';
import { getIDfromUsername } from '../Functions';

export function setStationAvailable() {
  const { username } = useAuthContext();
  useSetStationAvailableQuery(username);
}

export function setStationUnavailable() {
  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);
}

export function setStationUnknown(username: string) {
  const id = getIDfromUsername(username);

  const { error, isError, isLoading, isSuccess, mutateAsync } = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/unknown`, {
        method: 'POST',
      }),
  });
  return { error, isError, isLoading, isSuccess, mutateAsync };
}
