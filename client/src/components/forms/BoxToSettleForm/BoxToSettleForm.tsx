import React from 'react';
import { FormButton, FormHOC } from '@/components';

export const BoxToSettleForm = () => {
  const onSubmit = () => {
    // TODO: Navigate to another page?
    return;
  };

  return (
    <FormHOC onFinish={onSubmit} name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
    </FormHOC>
  );
};
