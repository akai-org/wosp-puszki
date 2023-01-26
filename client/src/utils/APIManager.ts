export class APIManager {
  static baseServerUrl = import.meta.env.VITE_SERVER_ADDRESS || 'http://localhost:8000';
  static baseAPIRUrl = `${this.baseServerUrl}/api`;

  static validateUserURL = `${this.baseAPIRUrl}/health`;
  static giveBoxURL = (volunteerId: number) =>
    `${this.baseAPIRUrl}/collectors/${volunteerId}/boxes`;
}
