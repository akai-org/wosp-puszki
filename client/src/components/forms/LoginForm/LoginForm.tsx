import { PASSWORD_REQUIRED, USERNAME_REQUIRED } from '@/utils';
import { FormButton, FormWrapper, FormInput } from '@/components';

interface LoginFormValues {
  username: string;
  password: string;
}

export const LoginForm = () => {
  const onSubmit = (values: LoginFormValues) => {
    // TODO: send values to BE
  };

  return (
    <FormWrapper onFinish={onSubmit}>
      <FormInput
        formItemName="username"
        label="Nazwa użytkownika"
        rules={[{ required: true, message: USERNAME_REQUIRED }]}
      />
      <FormInput
        isPassword
        formItemName="password"
        label="Hasło"
        rules={[{ required: true, message: PASSWORD_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit">
        Zaloguj
      </FormButton>
    </FormWrapper>
  );
};
