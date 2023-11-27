import type { FormRule } from 'antd';
import {
  APIManager,
  fetcher,
  PASSWORD_REQUIRED,
  PASSWORDS_DO_NOT_MATCH,
  recognizeError,
  USERNAME_REQUIRED,
} from '@/utils';
import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import type { Option, VolunteerType } from '@/utils';
import { useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import { useNavigate } from 'react-router';

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
  const [errorMessage, setErrorMessage] = useState<string | undefined>();
  const navigate = useNavigate();
  const mutation = useMutation({
    mutationFn: (values: NewUserValues) =>
      // {
      //   "userName": "Jan",
      //   "password": "qwerty123",
      //   "password_confirmation": "qwerty123",
      //   "role": "volounteer"
      // }
      fetcher(`http://localhost:8000/api/users`, {
        method: 'POST',
        body: {
          userName: values.username,
          password: values.password,
          password_confirmation: values.confirmPassword,
          type: values.userType,
        },
      }),
    // onSuccess: () => navigate
    onError: (error: unknown) => {
      setErrorMessage(recognizeError(error));
    },
  });

  const onSubmit = (values: NewUserValues) => {
    // TODO: Send to BE
    return;
  };
  return (
    <FormWrapper
      label="Dodaj użytkownika"
      initialValues={{ userType: 'Wolontariusz' }}
      name="newUserForm"
      onFinish={onSubmit}
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
