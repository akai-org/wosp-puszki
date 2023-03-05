# WOSP-puszki frontend

## Requirements

- Node.js >= 16.15.1 

## How to run

1. Install dependencies with `yarn`
2. Run `yarn run dev` to start development server


## Testing

Testing is based on the vitest, react-testing-library & UserEvent for emulating interactions with a browser. Setup is 
in `tests` folder. Mocking BE responses is done via [MSW](https://mswjs.io/). 

### Providers, Wrappers and the Wardrobe...

To test a component properly, we must provide it with a proper environment 
(wrappers) e.g. Router, Context, etc. Then we have to render it 
using these wrappers.

```tsx
    const utilities = render(<SomeComponent />, { wrapper: someWrapper });
```
Let's start from the ground up. In our `tests/utils/providers.tsx` directory
we have all needed (for now) providers factories defined. What is a provider factory? It's a function
that takes children and configuration object as arguments. Provider factory function returns 
jsx element, which consists of children argument wrapped in some needed dependencies - our providers
(e.g. context provider). 

Then we use `createCustomWrapper(someProvidersFactory)` to create wrapper. What does a wrapper
do? It takes configuration and returns another function, which takes reactNode as an argument
and finally returns our a call to `someProvided factory` with an element that we want to render and configuration. This
way we can change our rendering environment while creating testing element, without making additional functions etc.

#### Custom renderers

```typescript
renderWithWrapper(ui, wrapper)
```
This renderer creates ui element with given wrapper

```typescript
renderWithUser(ui, wrapper)
```
This renderer creates ui element with given wrapper and user object, so we can emulate browser actions (clicking buttons,
filling form inputs, etc.)






