import React from 'react';
import { Typography } from 'antd';
import { FormButton, FormInput, FormHOC } from '@/components';
import { FIRST_NAME_REQUIRED, ID_NUMBER_REQUIRED, LAST_NAME_REQUIRED } from '@/utils';
import type { IdNumber } from '@/utils';

interface NewVolunteerValues extends IdNumber {
  firstName: string;
  lastName: string;
}

export const NewVolunteerForm = () => {
  const title = (
    <>
      Dodaj wolontariusza
      <Typography.Text type="secondary"> ( tego z Puszką )</Typography.Text>
    </>
  );

  const onSubmit = (values: NewVolunteerValues) => {
    // TODOL send values to BE
    return;
  };

  return (
    <FormHOC onFinish={onSubmit} title={title} name="newVolunteerForm">
      <FormInput
        label="Numer identyfikatora"
        rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
        formItemName="idNumber"
      />
      <FormInput
        label="Imię"
        rules={[{ required: true, message: FIRST_NAME_REQUIRED }]}
        formItemName="firstName"
      />
      <FormInput
        label="Nazwisko"
        formItemName="lastName"
        rules={[{ required: true, message: LAST_NAME_REQUIRED }]}
      />
      <FormButton>Dodaj wolontariusza</FormButton>
    </FormHOC>
  );
};