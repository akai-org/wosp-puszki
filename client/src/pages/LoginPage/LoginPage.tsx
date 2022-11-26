import s from './LoginPage.module.less';
import { LoginForm, NewUserForm } from '../../components';
import { BoxHandOutForm } from '../../components/forms/BoxSpendingForm/BoxHandOutForm';

export const LoginPage = () => (
  <div className={s.container}>
    <BoxHandOutForm />
  </div>
);
