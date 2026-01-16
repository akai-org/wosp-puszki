import React from 'react';
import { FormButton, FormWrapper } from '@/components';
import { useNavigate } from 'react-router-dom';
import { createFullRoutePath, FIND_BOX_PAGE_ROUTE, SETTLE_PROCESS_PATH } from '@/utils';
import { CallForHelpView } from '@components/CallForHelp';

export const BoxToSettleForm = () => {
  const navigate = useNavigate();
  const onSubmit = () => {
    navigate(createFullRoutePath(SETTLE_PROCESS_PATH, FIND_BOX_PAGE_ROUTE));
    return;
  };

  return (
    <FormWrapper onFinish={onSubmit} name="boxToSettleForm">
      <FormButton htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
      <CallForHelpView />
    </FormWrapper>
  );
};
