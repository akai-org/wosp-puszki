import React from 'react';
import { FormButton, FormWrapper } from '@/components';

export const BoxToSettleForm = () => {
  const onSubmit = async () => {
    // TODO: Navigate to another page?
  };

  return (
    <FormWrapper onFinish={onSubmit} name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
    </FormWrapper>
  );
};
