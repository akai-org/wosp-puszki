import React from 'react';
import { useState } from 'react';
import { Space, Typography } from 'antd';
import s from './GiveBoxForm.module.less';
import { ID_NUMBER_REQUIRED, TYPE_OF_BOX_REQUIRED } from '@/utils';

import { FormWrapper, FormInput, FormSelect, FormButton } from '@/components';

const { Text } = Typography;

type FormInput = {
  id_number: string | number;
  box_type: 'box' | 'case';
};

export const GiveBoxForm = () => {
  const [error, setError] = useState(false);

  const onFinish = (values: FormInput) => {
    console.log('Success:', values);
  };

  const onFinishFailed = () => {
    console.log('Coś poszło nie tak przy wydawaniu puszki');
    setError(true);
  };

  return (
    <FormWrapper
      label="Wydawanie Puszki"
      name="giveBoxForm"
      onFinish={onFinish}
      onFinishFailed={onFinishFailed}
      errorMessage={error && 'Brak wolontariusza o takim identyfikatorze'}
    >
      <Space className={s.formInputs}>
        <Space className={s.inputField} size={0}>
          <Text className={s.inputFieldName}>Numer Identyfikatora: </Text>
          <FormInput
            name="id_number"
            className={s.input}
            rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
          />
        </Space>
        <FormSelect
          name="box_type"
          placeholder="Wybierz rodzaj"
          options={[
            {
              value: 'box',
              label: 'Puszka',
            },
            {
              value: 'case',
              label: 'Skarbonka',
            },
          ]}
          rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
        />
      </Space>
      <FormButton htmlType="submit" type="primary">
        Dodaj Puszkę
      </FormButton>
    </FormWrapper>
  );
};
