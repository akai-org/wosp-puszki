import {
  IAuthContext,
  NetworkError,
  PASSWORD_REQUIRED,
  USERNAME_REQUIRED,
} from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';
import { useContext, useState } from 'react';
import { AuthContext } from '@/App';
import { LoadingOutlined } from '@ant-design/icons';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const [errorMessage, setErrorMessage] = useState<string | undefined>();
  const [isWaiting, setIsWaiting] = useState(false);
  const { createCredentials } = useContext(AuthContext) as IAuthContext;
  const onSubmit = async (values: LoginFormValues) => {
    setIsWaiting(true);

    try {
      await createCredentials(values.username, values.password);
    } catch (e) {
      handleError(e);
    } finally {
      setIsWaiting(false);
    }

    function handleNetworkError(e: NetworkError) {
      if (e.status == 401) {
        setErrorMessage('Login lub hasło są nieprawidłowe');
      }
    }

    function handleError(e: unknown) {
      if (e instanceof NetworkError) {
        handleNetworkError(e);
      } else {
        setErrorMessage('Podczas logowania wystąpił błąd');
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
      <FormButton disabled={isWaiting} type="primary" htmlType="submit">
        {!isWaiting ? 'Zaloguj' : <LoadingOutlined style={{ fontSize: 24 }} spin />}
      </FormButton>
    </FormWrapper>
  );
};
