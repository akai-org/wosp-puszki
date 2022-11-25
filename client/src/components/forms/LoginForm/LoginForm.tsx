import { FormHOC } from '../FormHOC';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const onSubmit = (values: LoginFormValues) => {
    // TODO: send values to BE
  };

  return (
    <FormHOC onFinish={onSubmit}>
      <FormInput
        formItemName="username"
        label="Nazwa użytkownika"
        rules={[{ required: true, message: 'Wprowadź nazwę użytkownika' }]}
      />
      <FormInput
        isPassword
        formItemName="password"
        label="Hasło"
        rules={[{ required: true, message: 'Wprowadź hasło' }]}
      />
      <FormButton type="primary" htmlType="submit">
        Zaloguj
      </FormButton>
    </FormHOC>
  );
};
