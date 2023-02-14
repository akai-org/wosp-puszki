import { NetworkError } from '@/utils';

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
    return 'Wystąpił nieznany błąd';
  }

  function handleFetchError() {
    return 'Brak komunikacji z serwerem';
  }

  function handleServerError() {
    return 'Błąd po stronie servera';
  }

  function handleClientError(error: NetworkError) {
    if (error.status === 400 && error.statusText === 'Bad Request')
      return 'Nieprawidłowe dane';
    if (error.status === 401 && error.statusText === 'Unauthorized')
      return 'Nieprawidłowe dane logowania';
    if (error.status === 404 && error.statusText === 'Not Found') return 'Nie znaleziono';

    return `Błąd po stronie klienta: ${error.statusText}`;
  }
}

export function isFailedFetched(error: Error) {
  if (error.message === 'Failed to fetch') return true;
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
