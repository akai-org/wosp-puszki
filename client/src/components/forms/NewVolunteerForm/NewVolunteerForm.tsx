import React from 'react';
import { Typography } from 'antd';
import { FormHOC } from '../FormHOC';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';
import {
  FIRST_NAME_REQUIRED,
  ID_NUMBER_REQUIRED,
  LAST_NAME_REQUIRED,
} from '../../../utils';

export const NewVolunteerForm = () => {
  const title = (
    <>
      Dodaj wolontariusza
      <Typography.Text type="secondary"> ( tego z Puszką )</Typography.Text>
    </>
  );

  return (
    <FormHOC title={title} name="newVolunteerForm">
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
