import { Button, Form, Input } from 'antd';
import s from './LoginForm.module.less';
import { FormHOC } from '../FormHOC/FormHOC';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const onSubmit = (values: LoginFormValues) => {
    // TODO: send values to BE
  };

  return (
    <FormHOC submitHandler={onSubmit}>
      <Form.Item
        name="username"
        label="Nazwa użytkownika"
        rules={[{ required: true, message: 'Wprowadź nazwę użytkownika' }]}
      >
        <Input className={s.input} />
      </Form.Item>
      <Form.Item
        name="password"
        label="Hasło"
        rules={[{ required: true, message: 'Wprowadź hasło' }]}
      >
        <Input.Password className={s.input} />
      </Form.Item>
      <Form.Item>
        <Button type="primary" htmlType="submit" className={s.submitBtn}>
          Zaloguj
        </Button>
      </Form.Item>
    </FormHOC>
  );
};
