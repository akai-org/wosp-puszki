import { IDisplayPageContent, IStations, fetcher, APIManager } from '@/utils';
import { useQuery } from '@tanstack/react-query';

export const AMOUNTS_QUERY_KEY = ['amounts'];
export const STATION_AVAILABLE_QUERY_KEY = ['station-available'];
export const STATION_UNAVAILABLE_QUERY_KEY = ['station-unavailable'];

export const STATIONS_QUERY_KEY = ['stations'];
export const THREE_MINUTES = 1000 * 60 * 3;
export const amountsInitData: IDisplayPageContent = {
  amount_total_in_PLN: 0,
  amount_EUR: '0',
  amount_GBP: '0',
  amount_PLN: 0,
  collectors_in_city: 0,
  amount_USD: '0',
  amount_PLN_unconfirmed: 0,
  rates: {
    EUR: 0,
    GBP: 0,
    USD: 0,
  },
  amount_PLN_eskarbonka: 0,
};

export const stationState = {
  unavailable: 0,
  available: 1,
  occupied: 2,
};

export const stationsInitData: IStations[] = Array.from(Array(28)).map(
  (el, index): IStations => ({ s: index + 1, st: stationState.unavailable, t: null }),
);

export const useAmountsQuery = () =>
  useQuery(
    AMOUNTS_QUERY_KEY,
    () => fetcher<IDisplayPageContent>(`${APIManager.baseAPIRUrl}/stats`),
    { initialData: amountsInitData, refetchInterval: 3000, cacheTime: 3000 },
  );

export const useStationsQuery = () =>
  useQuery(
    STATIONS_QUERY_KEY,
    () => fetcher<IStations[]>(`${APIManager.baseAPIRUrl}/stations`),
    { initialData: stationsInitData, refetchInterval: 3000, cacheTime: 3000 },
  );

export const useSetStationAvailableQuery = (username: string | null | undefined) => {
  if (!username) {
    return;
  }
  const id = parseInt(username.slice(-2));
  return useQuery(
    STATION_AVAILABLE_QUERY_KEY,
    () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/ready`, {
        method: 'POST',
        returnVoid: true,
      }),
    { refetchInterval: THREE_MINUTES, cacheTime: THREE_MINUTES },
  );
};

export const useSetStationUnavailableQuery = (username: string | null | undefined) => {
  if (!username) {
    return;
  }
  const id = parseInt(username.slice(-2));
  return useQuery(
    STATION_UNAVAILABLE_QUERY_KEY,
    () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/busy`, {
        method: 'POST',
        returnVoid: true,
      }),
    { refetchInterval: THREE_MINUTES, cacheTime: THREE_MINUTES },
  );
};
