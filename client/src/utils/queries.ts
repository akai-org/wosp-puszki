import {
  IDisplayPageContent,
  IStations,
  fetcher,
  APIManager,
  isFailedFetched,
  openNotification,
  closeNotification,
  NO_CONNECT_WITH_SERVER,
  STATUS_CANT_BE_UPDATED,
  MULTIPLE_STATUS_CANT_BE_UPDATED,
  IBoxes,
  LogDataType,
  CANNOT_DOWNLOAD_DATA,
  IUser,
} from '@/utils';
import { useQuery } from '@tanstack/react-query';

export const AMOUNTS_QUERY_KEY = ['amounts'];
export const STATION_AVAILABLE_QUERY_KEY = ['station-available'];
export const STATION_UNAVAILABLE_QUERY_KEY = ['station-unavailable'];
export const GET_BOX_QUERY_KEY = ['get-box'];
export const UNVERIFIED_BOXES_QUERY_KEY = ['unverified-boxes'];
export const VERIFIED_BOXES_QUERY_KEY = ['verified-boxes'];

export const GET_USERS_QUERY_KEY = ['get-users'];

export const STATIONS_QUERY_KEY = ['stations'];
export const GET_LOGS_QUERY_KEY = ['get-logs'];

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
  (el, index): IStations => ({
    station: index + 1,
    status: stationState.unavailable,
    time: null,
  }),
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
    () =>
      fetcher<IStations[]>(`${APIManager.baseAPIRUrl}/stations`)
        .then((data) => {
          closeNotification();
          return data;
        })
        .catch((error) => {
          if (isFailedFetched(error))
            openNotification(
              'error',
              NO_CONNECT_WITH_SERVER,
              MULTIPLE_STATUS_CANT_BE_UPDATED,
            );
          throw error;
        }),
    { initialData: stationsInitData, refetchInterval: 3000, cacheTime: 3000 },
  );

export const useSetStationAvailableQuery = (username: string | null | undefined) => {
  if (!username) {
    return;
  }
  const id = parseInt(username.slice(-2));
  if (isNaN(id)) return;
  return useQuery(
    STATION_AVAILABLE_QUERY_KEY,
    () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/ready`, {
        method: 'POST',
        returnVoid: true,
      })
        .then(() => {
          closeNotification();
          return null;
        })
        .catch((error) => {
          if (isFailedFetched(error))
            openNotification('error', NO_CONNECT_WITH_SERVER, STATUS_CANT_BE_UPDATED);
          throw error;
        }),
    { refetchInterval: THREE_MINUTES, cacheTime: THREE_MINUTES },
  );
};

export const useSetStationUnavailableQuery = (username: string | null | undefined) => {
  if (!username) {
    return;
  }
  const id = parseInt(username.slice(-2));
  if (isNaN(id)) return;
  return useQuery(
    STATION_UNAVAILABLE_QUERY_KEY,
    () =>
      fetcher(`${APIManager.baseAPIRUrl}/stations/${id}/busy`, {
        method: 'POST',
        returnVoid: true,
      })
        .then(() => {
          closeNotification();
          return null;
        })
        .catch((error) => {
          if (isFailedFetched(error))
            openNotification('error', NO_CONNECT_WITH_SERVER, STATUS_CANT_BE_UPDATED);
          throw error;
        }),
    { refetchInterval: THREE_MINUTES, cacheTime: THREE_MINUTES },
  );
};

export const useUnverifiedBoxesQuery = () =>
  useQuery(
    UNVERIFIED_BOXES_QUERY_KEY,
    () =>
      fetcher<IBoxes[]>(`${APIManager.baseAPIRUrl}/charityBoxes/unverified`).catch(
        (error) => {
          openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
          throw error;
        },
      ),
    { initialData: [], refetchInterval: 3000, cacheTime: 3000 },
  );

export const useVerifiedBoxesQuery = () =>
  useQuery(
    VERIFIED_BOXES_QUERY_KEY,
    () =>
      fetcher<IBoxes[]>(`${APIManager.baseAPIRUrl}/charityBoxes/verified`).catch(
        (error) => {
          openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
          throw error;
        },
      ),
    { initialData: [], refetchInterval: 3000, cacheTime: 3000 },
  );

export const useGetBoxQuery = (id: string) =>
  useQuery(GET_BOX_QUERY_KEY, () =>
    fetcher<IBoxes>(`${APIManager.baseAPIRUrl}/charityBoxes/${id}`).catch((error) => {
      openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
      throw error;
    }),
  );

export const useGetLogsQuery = () =>
  useQuery(
    GET_LOGS_QUERY_KEY,
    () =>
      fetcher<LogDataType[]>(`${APIManager.baseAPIRUrl}/logs`).catch((error) => {
        openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
        throw error;
      }),
    { initialData: [], refetchInterval: 3000, cacheTime: 3000 },
  );

export const useGetUsersQuery = () =>
  useQuery(
    GET_USERS_QUERY_KEY,
    () =>
      fetcher<IUser[]>(`${APIManager.baseAPIRUrl}/users`).catch((error) => {
        openNotification('error', NO_CONNECT_WITH_SERVER, CANNOT_DOWNLOAD_DATA);
        throw error;
      }),
    { initialData: [] },
  );
