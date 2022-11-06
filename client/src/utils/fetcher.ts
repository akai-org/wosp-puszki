export interface FetcherRequestInit extends Omit<RequestInit, 'body'> {
  body?: object | string | number | boolean;
}

export async function fetcher<T = object>(
  url: string,
  customConfiguration = {} as FetcherRequestInit,
) {
  const headers = { 'Content-Type': 'application/json' };
  const configuration: RequestInit = {
    method: customConfiguration.body ? 'POST' : 'GET',
    headers,
    ...customConfiguration,
    body: customConfiguration.body ? JSON.stringify(customConfiguration.body) : undefined,
  };

  const response = await fetch(url, configuration);

  if (response.ok) {
    return (await response.json()) as T;
  } else {
    const errorMessage = await response.text();
    throw new Error(errorMessage);
  }
}
