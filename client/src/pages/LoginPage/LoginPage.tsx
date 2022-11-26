import s from './LoginPage.module.less';
import { LoginForm, NewUserForm } from '../../components';
import { BoxHandOutForm } from '../../components/forms/BoxSpendingForm/BoxHandOutForm';
import { BoxToSettleForm } from '../../components/forms/BoxToSettleForm/BoxToSettleForm';
import { NewVolunteerForm } from '../../components/forms/NewVolunteerForm/NewVolunteerForm';

export const LoginPage = () => (
  <div className={s.container}>
    <NewUserForm />
  </div>
);
