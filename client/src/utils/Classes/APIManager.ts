export class APIManager {
  static baseServerUrl = import.meta.env.VITE_SERVER_ADDRESS || 'http://localhost:8000';
  static baseAPIRUrl = `${this.baseServerUrl}/api`;

  static validateUserURL = `${this.baseAPIRUrl}/health`;
  static addCollectorURL = `${this.baseAPIRUrl}/collectors`;
  static usersURL = `${this.baseAPIRUrl}/users`;

  static giveBoxURL = (volunteerId: number) =>
    `${this.baseAPIRUrl}/collectors/${volunteerId}/box/create`;
  static findBoxURL = (volunteerId: number) =>
    `${this.baseAPIRUrl}/collectors/${volunteerId}/box/latestUncounted`;
}
