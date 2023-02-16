import { rest } from 'msw';
import { setupServer } from 'msw/node';

export const mockServer = setupServer();

export const mockEndpoint = (
  endpoint: string,
  { body = {}, httpVerb = `get`, status = 200 },
) => {
  mockServer.use(
    rest[httpVerb as keyof typeof rest](endpoint, (req, res, ctx) =>
      res(ctx.status(status), ctx.json(body)),
    ),
  );
};
