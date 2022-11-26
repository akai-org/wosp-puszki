import s from './LoginPage.module.less';
import { LoginForm, NewUserForm } from '../../components';

export const LoginPage = () => (
  <div className={s.container}>
    <NewUserForm />
  </div>
);
