import { describe, it, vi } from 'vitest';
import { render } from '@testing-library/react';
import { HomePage } from '@/pages';
import { BrowserRouter } from 'react-router-dom';
import { ReactElement, ReactNode } from 'react';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { AuthContext } from '@/App';
import { useAuthContextValues } from '@/utils';

const AllProviders = ({ children }: { children: ReactNode }) => {
  const queryClient = new QueryClient();
  const values: ReturnType<typeof useAuthContextValues> = {
    credentials: 'superpassword',
    deleteCredentials: vi.fn(),
    createCredentials: vi.fn(),
    username: 'superadmin',
  };
  return (
    <AuthContext.Provider value={values}>
      <QueryClientProvider client={queryClient}>
        <BrowserRouter>{children}</BrowserRouter>
      </QueryClientProvider>
    </AuthContext.Provider>
  );
};

const renderWithRouter = (ui: ReactElement) => {
  return {
    ...render(ui, {
      wrapper: AllProviders,
    }),
  };
};

describe('Testing HomePage', () => {
  it('Testing rendering', () => {
    const { getByTestId } = renderWithRouter(<HomePage />);
    expect(getByTestId('give-box-test-id')).toBeInTheDocument();
  });
});
