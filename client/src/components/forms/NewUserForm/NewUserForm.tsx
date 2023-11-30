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
import { useForm } from 'antd/lib/form/Form';

interface NewUserValues {
  username: string;
  password: string;
  confirmPassword: string;
  userType: VolunteerType;
}

const options: Option[] = [
  { value: 'volounteer', label: 'Wolontariusz' },
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
  const [form] = useForm();
  const [message, setMessage] = useState<FormMessage | undefined>();
  //TODO: add correct roles
  const mutation = useMutation({
    mutationFn: (values: NewUserValues) => {
      console.log(values);
      return fetcher(`http://localhost:8000/api/users`, {
        method: 'POST',
        body: {
          userName: values.username,
          password: values.password,
          password_confirmation: values.confirmPassword,
          role: values.userType,
        },
      });
    },

    onSuccess: (data) => {
      console.log(data);
      setMessage({ type: 'success', content: 'Pomyślnie dodano użytkownika' });
      form.resetFields();
    },
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
      form={form}
      label="Dodaj użytkownika"
      initialValues={{ userType: 'volounteer' }}
      name="newUserForm"
      onFinish={onSubmit}
      disabled={mutation.isLoading}
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
      <FormButton type="primary" htmlType="submit" isLoading={mutation.isLoading}>
        Dodaj użytkownika
      </FormButton>
    </FormWrapper>
  );
};
