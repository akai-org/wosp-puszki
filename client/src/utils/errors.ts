export class NetworkError extends Error {
  status;
  statusText;
  constructor(errorMessage: string, status: number, statusText: string) {
    super(errorMessage);
    this.status = status;
    this.statusText = statusText;
  }
}
