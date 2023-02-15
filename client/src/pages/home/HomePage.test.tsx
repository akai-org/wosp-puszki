import { describe, it } from 'vitest';
import { render } from '@testing-library/react';
import { HomePage } from '@/pages';
import { ReactElement } from 'react';
import { AllProvidersWrapper } from '../../../tests/utils/wrappers';

const renderWithRouter = (ui: ReactElement) => {
  return {
    ...render(ui, {
      wrapper: AllProvidersWrapper(),
    }),
  };
};

describe('Testing HomePage', () => {
  it('Testing rendering', () => {
    const { getByTestId } = renderWithRouter(<HomePage />);
    expect(getByTestId('give-box-test-id')).toBeInTheDocument();
  });
});
