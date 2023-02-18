import React from 'react';
import { FormButton, FormWrapper } from '@/components';
import { useNavigate } from 'react-router-dom';

export const BoxToSettleForm = () => {
  const navigate = useNavigate();
  const onSubmit = () => {
    navigate('/liczymy/boxes/settle/1');
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
