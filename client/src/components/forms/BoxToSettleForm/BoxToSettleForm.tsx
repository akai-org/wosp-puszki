import React from 'react';
import { FormHOC } from '../FormHOC';
import { FormButton } from '../FormButton';

export const BoxToSettleForm = () => {
  return (
    <FormHOC name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
    </FormHOC>
  );
};
