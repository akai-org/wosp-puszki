import React from 'react';
import { FormHOC } from '../FormHOC';
import { Option, VolunteerType } from '../../../utils/types';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';
import { FormSelect } from '../FormSelect/FormSelect';
import { FormRule } from 'antd';

interface NewUserValues {
  username: string;
  password: string;
  confirmPassword: string;
  userType: VolunteerType;
}

const options: Option[] = [{ value: 'Wolontariusz', label: 'Wolontariusz' }];

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
    <FormHOC submitHandler={onSubmit}>
      <FormInput
        label="Nazwa użytkownika"
        name="username"
        rules={[{ required: true, message: 'Nazwa użytkownika jest wymagana' }]}
      />
      <FormInput
        isPassword
        label="Hasło"
        name="password"
        rules={[{ required: true, message: 'Hasło jest wymagane' }]}
      />
      <FormInput
        isPassword
        label="Potwierdzenie hasła"
        name="confirmPassword"
        dependencies={['password']}
        rules={[
          { required: true, message: 'Powtórzenie hasła jest wymagane' },
          validateConfirmPassword,
        ]}
      />
      <FormSelect
        defaultValue="Wolontariusz"
        label="Typ użytkownika"
        name="userType"
        options={options}
      />
      <FormButton buttonText="Dodaj użytkownika" type="primary" htmlType="submit" />
    </FormHOC>
  );
};
