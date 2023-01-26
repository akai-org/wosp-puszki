import {
  LOGIN_EXCEPTION,
  NetworkError,
  PASSWORD_REQUIRED,
  useAuthContext,
  USERNAME_REQUIRED,
  WRONG_USER_CREDENTIALS,
} from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';
import { useState } from 'react';
import { LoadingOutlined } from '@ant-design/icons';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const [errorMessage, setErrorMessage] = useState<string | undefined>();
  const [isLoading, setIsLoading] = useState(false);
  const { createCredentials } = useAuthContext();
  const onSubmit = async (values: LoginFormValues) => {
    setIsLoading(true);

    try {
      await createCredentials(values.username, values.password);
    } catch (e) {
      handleError(e);
    } finally {
      setIsLoading(false);
    }

    function handleNetworkError(e: NetworkError) {
      if (e.status == 401) {
        setErrorMessage(WRONG_USER_CREDENTIALS);
      }
    }

    function handleError(e: unknown) {
      if (e instanceof NetworkError) {
        handleNetworkError(e);
      } else {
        setErrorMessage(LOGIN_EXCEPTION);
      }
    }
  };

  return (
    <FormWrapper
      disabled={isLoading}
      onFinish={onSubmit}
      message={errorMessage ? { type: 'error', content: errorMessage } : undefined}
    >
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
        {isLoading ? <LoadingOutlined style={{ fontSize: 24 }} spin /> : 'Zaloguj'}
      </FormButton>
    </FormWrapper>
  );
};
