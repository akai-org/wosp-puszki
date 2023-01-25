import {
  IAuthContext,
  NetworkError,
  PASSWORD_REQUIRED,
  USERNAME_REQUIRED,
} from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';
import { useContext, useState } from 'react';
import { AuthContext } from '@/App';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const [errorMessage, setErrorMessage] = useState<string | undefined>();
  const { createCredentials } = useContext(AuthContext) as IAuthContext;
  const onSubmit = async (values: LoginFormValues) => {
    try {
      await createCredentials(values.username, values.password);
    } catch (e) {
      if (e instanceof NetworkError) {
        if (e.status == 401) {
          setErrorMessage('Login lub hasło są nieprawidłowe');
        }
      } else {
        console.log(e);
      }
    }
  };

  return (
    <FormWrapper onFinish={onSubmit} errorMessage={errorMessage}>
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
