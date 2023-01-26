import React from 'react';
import { FormButton, FormWrapper } from '@/components';
import { APIManager, fetcher } from '@/utils';

export const BoxToSettleForm = () => {
  const onSubmit = async () => {
    // TODO: Navigate to another page?
  };

  const readyToSettle = async (e: MouseEvent) => {
    e.stopPropagation();
    console.log('ready to settle another box');
    try {
      await fetcher(APIManager.baseAPIRUrl + '/some/path', { method: 'POST', body: '' });
    } catch (e) {
      console.log(e);
    }
  };

  const stopSettlingBox = async (e: MouseEvent) => {
    e.stopPropagation();
    console.log('Stop settling box');
    try {
      await fetcher(APIManager.baseAPIRUrl + '/some/path', { method: 'POST', body: '' });
    } catch (e) {
      console.log(e);
    }
  };

  const goOnABreak = async (e: MouseEvent) => {
    e.stopPropagation();
    console.log('Go on a break');
    try {
      await fetcher(APIManager.baseAPIRUrl + '/some/path', { method: 'POST', body: '' });
    } catch (e) {
      console.log(e);
    }
  };

  return (
    <FormWrapper onFinish={onSubmit} name="boxToSettleForm">
      <FormButton onClick={readyToSettle} htmlType="submit" type="primary">
        Jestem gotowy rozliczyć następną puszkę
      </FormButton>
      Poniżej jest dla testów
      <FormButton onClick={stopSettlingBox} type="primary">
        Zakończ rozliczać puszkę
      </FormButton>
      <FormButton onClick={goOnABreak} type="primary">
        idę na przerwę
      </FormButton>
    </FormWrapper>
  );
};
