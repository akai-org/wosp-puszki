import { NetworkError } from '@utils/errors';
import { STORAGE_CREDENTIALS } from '@utils/storageKeys';

export interface FetcherRequestInit extends Omit<RequestInit, 'body'> {
  body?: object | string | number | boolean;
  public?: boolean;
  returnVoid?: boolean;
}

export async function fetcher<T = object>(
  url: string,
  customConfiguration = { public: false, returnVoid: false } as FetcherRequestInit,
) {
  const baseHeaders: Record<string, string> = {
    'Content-Type': 'application/json',
  };

  const credentials = localStorage.getItem(STORAGE_CREDENTIALS);
  if (credentials && !customConfiguration.public) {
    baseHeaders.Authorization = `Basic ${credentials}`;
  }

  const { headers, ...customConfig } = customConfiguration;
  const configuration: RequestInit = {
    method: customConfig.body ? 'POST' : 'GET',
    headers: { ...baseHeaders, ...headers },
    ...customConfig,
    body: customConfig.body ? JSON.stringify(customConfiguration.body) : undefined,
  };

  const response = await fetch(url, configuration);
  if (response.ok && response.headers.get('Content-Type') === 'application/json') {
    return (await response.json()) as T;
  } else if (response.ok) {
    return (await response.text()) as T;
  } else {
    const errorMessage = await response.text();
    throw new NetworkError(errorMessage, response.status, response.statusText);
  }
}
