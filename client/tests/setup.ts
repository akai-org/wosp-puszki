import { expect, afterEach } from 'vitest';
import { cleanup } from '@testing-library/react';
import matchers from '@testing-library/jest-dom/matchers';
import { mockServer } from './utils/MSWSetup';
import { fetch } from 'cross-fetch';

// extends Vitest's expect method with methods from react-testing-library
expect.extend(matchers);

global.fetch = fetch;

// runs a cleanup after each test case (e.g. clearing jsdom)
beforeAll(() => mockServer.listen({ onUnhandledRequest: `error` }));
afterAll(() => mockServer.close());
afterEach(() => {
  mockServer.resetHandlers();
  cleanup();
});
