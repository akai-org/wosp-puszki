import React from 'react';
import { FormButton, FormInput, FormWrapper } from '@/components';
import { ID_NUMBER_REQUIRED } from '@/utils';
import type { IdNumber } from '@/utils';

export const BoxHandOutForm = () => {
  const onSubmit = (values: IdNumber) => {
    // TODO: send values to BE
    return;
  };

  return (
    <FormWrapper onFinish={onSubmit} name="boxHandoutForm" label="Wydawanie puszki">
      <FormInput
        label="Numer identyfikatora"
        name="idNumber"
        rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit">
        Wydaj puszkę
      </FormButton>
    </FormWrapper>
  );
};
