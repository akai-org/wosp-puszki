import { IDisplayPageContent, IStations } from '@utils/types';
import { useQuery } from '@tanstack/react-query';
import { fetcher } from '@utils/fetcher';
import { APIManager } from '@utils/APIManager';

export const AMOUNTS_QUERY_KEY = ['amounts'];

export const STATIONS_QUERY_KEY = ['stations'];
export const API_QUERY_KEY = ['api'];
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
    { initialData: amountsInitData, refetchInterval: 20 },
  );

export const useStationsQuery = () =>
  useQuery(
    STATIONS_QUERY_KEY,
    () => fetcher<IStations[]>(`${APIManager.baseAPIRUrl}/stations`),
    { initialData: stationsInitData, refetchInterval: 20 },
  );


