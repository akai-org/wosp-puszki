import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import { ID_NUMBER_REQUIRED, TYPE_OF_BOX_REQUIRED } from '@/utils';
import { Typography, Space, Button } from 'antd';
import { Content } from 'antd/lib/layout/layout';
import s from './FindBoxForm.module.less';
import { useState } from 'react';
const { Text } = Typography;

const options = [
  { value: 'puszka', label: 'Puszka' },
  { value: 'skarbonka', label: 'Skarbonka' },
];

export const FindBoxForm = () => {
  const onSubmit = () => {
    // TODO: Check if
    return;
  };

  const handleBreak = () => {
    // TODO: request ze to stanowisko nie jest gotowe?
    return;
  };

  const [error, setError] = useState(true);

  return (
    <Content className={s.container}>
      <FormWrapper
        onFinish={onSubmit}
        name="boxToSettleForm"
        className={s.form}
        borderColor="black"
        label="Znajdź puszkę do rozliczenia"
        errorMessage={
          error &&
          'Wszystkie puszki wolontariusza Patrycja Majewski ( 123 ) są rozliczone'
        }
      >
        <Space direction="vertical">
          <Space direction="vertical" className={s.form}>
            <Space className={s.inputContainer} size={0}>
              <Text className={s.text}>Numer Identyfikatora:</Text>
              <FormInput
                name="idNumber"
                className={s.input}
                placeholder="Np. 123"
                rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
              />
            </Space>
            <FormSelect
              name="boxType"
              options={options}
              placeholder="Wybierz rodzaj"
              className={s.select}
              rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
            />
            <FormButton htmlType="submit" type="primary">
              Wyszukaj puszkę
            </FormButton>
          </Space>
        </Space>
      </FormWrapper>
      <Button type="primary" className={s.break} onClick={handleBreak}>
        Nie chcę rozliczać dalej - przerwa
      </Button>
    </Content>
  );
};
