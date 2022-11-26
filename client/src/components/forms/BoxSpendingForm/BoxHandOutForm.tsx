import React from 'react';
import { FormHOC } from '../FormHOC';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';

export const BoxHandOutForm = () => {
  return (
    <FormHOC name="boxHandoutForm" title="Wydawanie puszki">
      <FormInput
        label="Numer identyfikatora"
        formItemName="idNumber"
        rules={[{ required: true, message: 'Numer identyfikatora jest wymagany' }]}
      />
      <FormButton type="primary" htmlType="submit">
        Dodaj puszkę
      </FormButton>
    </FormHOC>
  );
};
