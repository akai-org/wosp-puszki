import { Main } from '@components/main';
import { FindBoxForm } from '@/components/forms/FindBoxForm';

// Only for dev builds
import { AcceptDataPage } from '../boxes/AcceptDataPage/AcceptDataPage';
import { DepositBoxForm } from '@/components/forms/DepositBoxForm';

export const HomePage = () => {
  return <DepositBoxForm />;
};
