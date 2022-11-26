import s from './LoginPage.module.less';
import { LoginForm, NewUserForm } from '../../components';
import { BoxHandOutForm } from '../../components/forms/BoxSpendingForm/BoxHandOutForm';
import { BoxToSettleForm } from '../../components/forms/BoxToSettleForm/BoxToSettleForm';

export const LoginPage = () => (
  <div className={s.container}>
    <BoxToSettleForm />
  </div>
);
