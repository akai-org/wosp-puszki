import s from './LoginPage.module.less';
import { NewUserForm } from '../../components/forms/NewUserForm';

export const LoginPage = () => (
  <div className={s.container}>
    <NewUserForm />
  </div>
);
