import React from 'react';
import { FormButton, FormHOC } from '@/components';

export const BoxToSettleForm = () => {
  return (
    <FormHOC name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
    </FormHOC>
  );
};
