import { fetcher } from '../fetcher';
import { useMutation } from '@tanstack/react-query';
import { APIManager } from '../Classes';

export const useFinishCounting = (boxIdentifier: string | null) => {
  const { error, isError, isLoading, isSuccess, mutateAsync } = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}/finishCounting`, {
        method: 'POST',
      }),
  });

  return { error, isError, isLoading, isSuccess, mutateAsync };
};
