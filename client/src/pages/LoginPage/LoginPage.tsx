import { LoginForm } from '../../components';
import { Space } from 'antd';
import s from './LoginPage.module.css';

export const LoginPage = () => (
  <Space align="center" className={s.container}>
    <LoginForm />
  </Space>
);
