import React from 'react';
import { FormHOC } from '../FormHOC';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';
import { ID_NUMBER_REQUIRED } from '../../../utils';

export const BoxHandOutForm = () => {
  return (
    <FormHOC name="boxHandoutForm" title="Wydawanie puszki">
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
