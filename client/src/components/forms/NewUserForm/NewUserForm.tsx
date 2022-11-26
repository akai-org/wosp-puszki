import type { FormRule } from 'antd';
import { PASSWORD_REQUIRED, PASSWORDS_DO_NOT_MATCH, USERNAME_REQUIRED } from '@/utils';
import { FormButton, FormHOC, FormInput, FormSelect } from '@/components';
import type { Option, VolunteerType } from '@/utils';

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
    return Promise.reject(new Error(PASSWORDS_DO_NOT_MATCH));
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
        rules={[{ required: true, message: USERNAME_REQUIRED }]}
      />
      <FormInput
        isPassword
        label="Hasło"
        formItemName="password"
        rules={[{ required: true, message: PASSWORD_REQUIRED }]}
      />
      <FormInput
        isPassword
        label="Potwierdzenie hasła"
        formItemName="confirmPassword"
        dependencies={['password']}
        rules={[{ required: true, message: PASSWORD_REQUIRED }, validateConfirmPassword]}
      />
      <FormSelect label="Typ użytkownika" name="userType" options={options} />
      <FormButton type="primary" htmlType="submit">
        Dodaj użytkownika
      </FormButton>
    </FormHOC>
  );
};
