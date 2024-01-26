import {
  NetworkError,
  UNKNOWN_ERROR,
  NO_CONNECT_WITH_SERVER,
  SERVER_SIDE_ERROR,
  WRONG_DATA,
  WRONG_LOGIN_DATA,
  NOT_FOUND_DATA,
  FAILED_FETCH,
  BAD_REQUEST,
  UNAUTHORIZED,
  NOT_FOUND,
} from '@/utils';

export function recognizeError(error: unknown) {
  if (error instanceof NetworkError) {
    if (isClientError(error)) return handleClientError(error);
    if (isServerError(error)) return handleServerError();
  } else if (error instanceof Error && isFailedFetched(error)) {
    return handleFetchError();
  } else {
    return handleDefaultError(error);
  }

  function handleDefaultError(error: unknown) {
    if (typeof error === 'string') return error;
    return UNKNOWN_ERROR;
  }

  function handleFetchError() {
    return NO_CONNECT_WITH_SERVER;
  }

  function handleServerError() {
    return SERVER_SIDE_ERROR;
  }

  function handleClientError(error: NetworkError) {
    if (error.status === 400 && error.statusText === BAD_REQUEST) return WRONG_DATA;
    if (error.status === 401 && error.statusText === UNAUTHORIZED)
      return WRONG_LOGIN_DATA;
    if (error.status === 404 && error.statusText === NOT_FOUND) return NOT_FOUND_DATA;

    return `Błąd po stronie klienta: ${error.statusText}`;
  }
}

export function isFailedFetched(error: unknown) {
  if (error instanceof Error && error.message === FAILED_FETCH) return true;
  return false;
}

export function isClientError(error: NetworkError) {
  if (error.status >= 400 && error.status < 500) return true;
  return false;
}

export function isServerError(error: NetworkError) {
  if (error.status >= 500 && error.status < 600) return true;
  return false;
}

export function getIsBoxAlreadySettlingError(error: unknown) {
  if (error instanceof Error && typeof error.message === 'string') {
    const parsed = JSON.parse(error.message);
    if (parsed.error_message && parsed.status === 500) {
      return parsed.error_message;
    }
  }
  return false;
}
