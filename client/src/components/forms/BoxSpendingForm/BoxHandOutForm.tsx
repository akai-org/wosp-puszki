import React from 'react';
import { FormButton, FormInput, FormHOC } from '@/components';
import { ID_NUMBER_REQUIRED } from '@/utils';
import type { IdNumber } from '@/utils';

export const BoxHandOutForm = () => {
  const onSubmit = (values: IdNumber) => {
    // TODO: send values to BE
    return;
  };

  return (
    <FormHOC onFinish={onSubmit} name="boxHandoutForm" title="Wydawanie puszki">
      <FormInput
        label="Numer identyfikatora"
        formItemName="idNumber"
        rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit">
        Dodaj puszkę
      </FormButton>
    </FormHOC>
  );
};
