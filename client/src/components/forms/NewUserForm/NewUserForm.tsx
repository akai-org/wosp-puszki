import React from 'react';
import { FormHOC } from '../FormHOC';
import { Option, VolunteerType } from '../../../utils/types';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';
import { FormSelect } from '../FormSelect';
import type { FormRule } from 'antd';

interface NewUserValues {
  username: string;
  password: string;
  confirmPassword: string;
  userType: VolunteerType;
}

const options: Option[] = [
  { value: 'Wolontariusz', label: 'Wolontariusz' },
  { value: 'admin', label: 'Admin' },
  { value: 'superadmin', label: 'Superadmin' },
];

const validateConfirmPassword: FormRule = ({ getFieldValue }) => ({
  validator(_, value) {
    if (!value || getFieldValue('password') === value) {
      return Promise.resolve();
    }
    return Promise.reject(new Error('Hasła nie są zgodne'));
  },
});

export const NewUserForm = () => {
  const onSubmit = (values: NewUserValues) => {
    // TODO: Send to BE
    return;
  };
  return (
    <FormHOC
      title="Dodaj użytkownika"
      initialValues={{ userType: 'Wolontariusz' }}
      name="newUserForm"
      onFinish={onSubmit}
    >
      <FormInput
        label="Nazwa użytkownika"
        formItemName="username"
        rules={[{ required: true, message: 'Nazwa użytkownika jest wymagana' }]}
      />
      <FormInput
        isPassword
        label="Hasło"
        formItemName="password"
        rules={[{ required: true, message: 'Hasło jest wymagane' }]}
      />
      <FormInput
        isPassword
        label="Potwierdzenie hasła"
        formItemName="confirmPassword"
        dependencies={['password']}
        rules={[
          { required: true, message: 'Powtórzenie hasła jest wymagane' },
          validateConfirmPassword,
        ]}
      />
      <FormSelect label="Typ użytkownika" name="userType" options={options} />
      <FormButton type="primary" htmlType="submit">
        Dodaj użytkownika
      </FormButton>
    </FormHOC>
  );
};
