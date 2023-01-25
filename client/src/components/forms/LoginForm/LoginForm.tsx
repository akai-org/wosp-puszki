import { IAuthContext, PASSWORD_REQUIRED, USERNAME_REQUIRED } from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';
import { useContext } from 'react';
import { AuthContext } from '@/App';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const { createCredentials } = useContext(AuthContext) as IAuthContext;
  const onSubmit = (values: LoginFormValues) => {
    createCredentials(values.username, values.password);
  };

  return (
    <FormWrapper onFinish={onSubmit}>
      <FormInput
        name="username"
        label="Nazwa użytkownika"
        rules={[{ required: true, message: USERNAME_REQUIRED }]}
      />
      <FormInput
        isPassword
        name="password"
        label="Hasło"
        rules={[{ required: true, message: PASSWORD_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit">
        Zaloguj
      </FormButton>
    </FormWrapper>
  );
};
