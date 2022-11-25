import { FormHOC } from '../FormHOC/FormHOC';
import { FormInput } from '../FormInput/FormInput';
import { FormButton } from '../FormButton/FormButton';

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
      <FormInput
        name="username"
        label="Nazwa użytkownika"
        rules={[{ required: true, message: 'Wprowadź nazwę użytkownika' }]}
      />
      <FormInput
        isPassword
        name="password"
        label="Hasło"
        rules={[{ required: true, message: 'Wprowadź hasło' }]}
      />
      <FormButton buttonText="Zaloguj" type="primary" htmlType="submit" />
    </FormHOC>
  );
};
