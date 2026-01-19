export class APIManager {
  static baseServerUrl = import.meta.env.VITE_SERVER_ADDRESS || 'http://localhost:8000';
  static baseAPIRUrl = `${this.baseServerUrl}/api`;

  static validateUserURL = `${this.baseAPIRUrl}/health`;
  static addCollectorURL = `${this.baseAPIRUrl}/collectors`;
  static usersURL = `${this.baseAPIRUrl}/users`;
  static getStationsURL = `${this.baseAPIRUrl}/stations/all`;

  static giveBoxURL = (volunteerId: number | string) =>
    `${this.baseAPIRUrl}/collectors/${volunteerId}/box/create`;
  static findBoxURL = (volunteerId: number | string) =>
    `${this.baseAPIRUrl}/collectors/${volunteerId}/box/latestUncounted`;
  static setStationReadyDeployedURL = (stationId: number) =>
    `${this.baseAPIRUrl}/stations/${stationId}/ready-deployed`;
  static setStationReadyURL = (stationId: number) =>
    `${this.baseAPIRUrl}/stations/${stationId}/ready`;
  static helpRequestUrl = `${this.baseAPIRUrl}/help/request`;
  static helpResolveUrl = `${this.baseAPIRUrl}/help/resolve`;
}
