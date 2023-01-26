import {
  LOGIN_EXCEPTION,
  NetworkError,
  PASSWORD_REQUIRED,
  useAuthContext,
  USERNAME_REQUIRED,
  WRONG_USER_CREDENTIALS,
} from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';
import { Dispatch, SetStateAction, useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import { Spinner } from '@components/Layout/Spinner/Spinner';

interface LoginFormValues {
  username: string;
  password: string;
}

function handleError(
  e: unknown,
  setErrorMessage: Dispatch<SetStateAction<string | undefined>>,
) {
  if (e instanceof NetworkError) {
    handleNetworkError(e);
  } else {
    setErrorMessage(LOGIN_EXCEPTION);
  }
  function handleNetworkError(e: NetworkError) {
    if (e.status == 401) {
      setErrorMessage(WRONG_USER_CREDENTIALS);
    }
  }
}

export const LoginForm = () => {
  const [errorMessage, setErrorMessage] = useState<string | undefined>();
  const { createCredentials } = useAuthContext();
  const mutation = useMutation({
    mutationFn: (values: LoginFormValues) =>
      createCredentials(values.username, values.password),
    onError: (error) => handleError(error, setErrorMessage),
  });
  const onSubmit = async (values: LoginFormValues) => {
    setErrorMessage(undefined);
    mutation.mutate(values);
  };

  return (
    <FormWrapper
      disabled={mutation.isLoading}
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
        {mutation.isLoading ? <Spinner /> : 'Zaloguj'}
      </FormButton>
    </FormWrapper>
  );
};
