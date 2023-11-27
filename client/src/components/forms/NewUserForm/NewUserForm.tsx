import type { FormRule } from 'antd';
import {
  fetcher,
  PASSWORD_REQUIRED,
  PASSWORDS_DO_NOT_MATCH,
  recognizeError,
  USERNAME_REQUIRED,
} from '@/utils';
import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import type { FormMessage, Option, VolunteerType } from '@/utils';
import { useState } from 'react';
import { useMutation } from '@tanstack/react-query';

interface NewUserValues {
  username: string;
  password: string;
  confirmPassword: string;
  userType: VolunteerType;
}

const options: Option[] = [
  { value: 'collector', label: 'Wolontariusz' },
  { value: 'collectorcoordinator', label: 'Koordynator wolontariuszy' },
  { value: 'admin', label: 'Admin' },
  { value: 'superadmin', label: 'Superadmin' },
];

const validateConfirmPassword: FormRule = ({ getFieldValue }) => ({
  validator(_, value) {
    if (!value || getFieldValue('password') === value) {
      return Promise.resolve();
    }
    return Promise.reject(new Error(PASSWORDS_DO_NOT_MATCH));
  },
});

export const NewUserForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const mutation = useMutation({
    mutationFn: (values: NewUserValues) =>
      fetcher(`http://localhost:8000/api/users`, {
        method: 'POST',
        body: {
          userName: values.username,
          password: values.password,
          password_confirmation: values.confirmPassword,
          type: values.userType,
        },
      }),
    onSuccess: () =>
      setMessage({ type: 'error', content: 'Pomyślnie dodano użytkownika' }),
    onError: (error: unknown) =>
      setMessage({
        type: 'error',
        content: recognizeError(error),
      }),
  });

  const onSubmit = (values: NewUserValues) => {
    mutation.mutate(values);
  };
  return (
    <FormWrapper
      label="Dodaj użytkownika"
      initialValues={{ userType: 'Wolontariusz' }}
      name="newUserForm"
      onFinish={onSubmit}
      message={message}
    >
      <FormInput
        label="Nazwa użytkownika"
        name="username"
        rules={[{ required: true, message: USERNAME_REQUIRED }]}
      />
      <FormInput
        isPassword
        label="Hasło"
        name="password"
        rules={[{ required: true, message: PASSWORD_REQUIRED }]}
      />
      <FormInput
        isPassword
        label="Potwierdzenie hasła"
        name="confirmPassword"
        dependencies={['password']}
        rules={[{ required: true, message: PASSWORD_REQUIRED }, validateConfirmPassword]}
      />
      <FormSelect label="Typ użytkownika" name="userType" options={options} />
      <FormButton type="primary" htmlType="submit">
        Dodaj użytkownika
      </FormButton>
    </FormWrapper>
  );
};
