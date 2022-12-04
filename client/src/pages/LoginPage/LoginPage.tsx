import s from './LoginPage.module.less';
import { LoginForm } from '@/components';

export const LoginPage = () => (
  <div className={s.container}>
    <LoginForm />
  </div>
);
