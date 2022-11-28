import React from 'react';
import { FormButton, FormWrapper } from '@/components';

export const BoxToSettleForm = () => {
  const onSubmit = () => {
    // TODO: Navigate to another page?
    return;
  };

  return (
    <FormWrapper onFinish={onSubmit} name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
    </FormWrapper>
  );
};
