import {
  COUNTED_BY_NAME_REQUIRED,
  COUNTED_BY_PHONE_REQUIRED,
  MAIN_ROUTE,
  useCountedByContext,
} from '@/utils';
import { FormButton, FormInput, FormWrapper } from '@/components';
import s from '@components/boxes/FindBoxForm/FindBoxForm.module.less';
import { Content } from 'antd/lib/layout/layout';
import Title from 'antd/lib/typography/Title';
import { useNavigate } from 'react-router-dom';

interface CountedByFormValues {
  first_counted_by_name: string;
  first_counted_by_phone: string;
  second_counted_by_name: string;
  second_counted_by_phone: string;
}

export const CountedByPage = () => {
  const navigate = useNavigate();
  const { countedBy, setCountedBy } = useCountedByContext();
  const onSubmit = (values: CountedByFormValues) => {
    setCountedBy({
      first_counted_by_name: values.first_counted_by_name,
      first_counted_by_phone: values.first_counted_by_phone,
      second_counted_by_name: values.second_counted_by_name,
      second_counted_by_phone: values.second_counted_by_phone,
    });
    navigate(`/${MAIN_ROUTE}`);
  };

  return (
    <Content className={s.container}>
      <FormWrapper
        onFinish={onSubmit}
        label="Zanim przejdziesz dalej, podaj swoje dane"
        style={{ alignItems: 'center' }}
        initialValues={{
          first_counted_by_name: countedBy?.first_counted_by_name,
          first_counted_by_phone: countedBy?.first_counted_by_phone,
          second_counted_by_name: countedBy?.second_counted_by_name,
          second_counted_by_phone: countedBy?.second_counted_by_phone,
        }}
      >
        <Title level={3}>Osoba nr. 1</Title>
        <FormInput
          name="first_counted_by_name"
          label="Imię i nazwisko"
          rules={[{ required: true, message: COUNTED_BY_NAME_REQUIRED }]}
        />
        <FormInput
          name="first_counted_by_phone"
          label="Numer telefonu"
          maxLength={12}
          rules={[{ required: true, message: COUNTED_BY_PHONE_REQUIRED }]}
          value={countedBy?.first_counted_by_phone}
        />
        <hr />
        <Title level={2}>Osoba nr. 2</Title>
        <FormInput
          name="second_counted_by_name"
          label="Imię i nazwisko"
          rules={[{ required: true, message: COUNTED_BY_NAME_REQUIRED }]}
          value={countedBy?.second_counted_by_name}
        />
        <FormInput
          name="second_counted_by_phone"
          label="Numer telefonu"
          maxLength={12}
          rules={[{ required: true, message: COUNTED_BY_PHONE_REQUIRED }]}
          value={countedBy?.second_counted_by_phone}
        />
        <FormButton type="primary" htmlType="submit">
          Zapisz
        </FormButton>
      </FormWrapper>
    </Content>
  );
};
