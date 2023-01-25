import * as process from 'process';

export class APIManager {
  static baseServerUrl = process.env.REACT_APP_SERVER_ADDRESS || 'http://localhost:8000';
  static baseAPIRUrl = `${this.baseServerUrl}/api`;

  static validateUserURL = `${this.baseAPIRUrl}/health`;
}
