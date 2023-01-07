import React from 'react';
import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import { ID_NUMBER_REQUIRED, TYPE_OF_BOX_REQUIRED } from '@/utils';
import { Typography, Space, Button } from 'antd';
import { Content } from 'antd/lib/layout/layout';
import s from './FindBoxForm.module.less';
const { Title, Text } = Typography;

const options = [
  { value: 'puszka', label: 'Puszka' },
  { value: 'skarbonka', label: 'Skarbonka' },
];

export const FindBoxForm = () => {
  const onSubmit = () => {
    // TODO: Navigate to another page?
    return;
  };

  return (
    <Content className={s.container}>
      <Button type="primary" className={s.break}>
        Nie chcę rozliczać dalej - przerwa
      </Button>
      <FormWrapper
        onFinish={onSubmit}
        name="boxToSettleForm"
        className={s.form}
        borderColor="black"
      >
        <Space direction="vertical">
          <Title level={4} className={s.title}>
            Znajdź puszkę do rozliczenia
          </Title>
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
            <FormButton htmlType="submit" type="primary" className={s.submitButton}>
              Wyszukaj puszkę
            </FormButton>
          </Space>
        </Space>
      </FormWrapper>
    </Content>
  );
};
