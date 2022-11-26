import React from 'react';
import { FormHOC } from '../FormHOC';
import { FormInput } from '../FormInput';
import { FormButton } from '../FormButton';
import s from './NewVolunteerForm.module.less';

export const NewVolunteerForm = () => {
  const title = (
    <>
      Dodaj wolontariusza <span className={s.span}>(tego z puszką)</span>
    </>
  );

  return (
    <FormHOC title={title} name="newVolunteerForm">
      <FormInput
        label="Numer identyfikatora"
        rules={[{ required: true, message: 'Numer identyfikatora jest wymagany' }]}
        formItemName="idNumber"
      />
      <FormInput
        label="Imię"
        rules={[{ required: true, message: 'Imię jest wymagane' }]}
        formItemName="firstName"
      />
      <FormInput
        label="Nazwisko"
        formItemName="surname"
        rules={[{ required: true, message: 'Nazwisko jest wymagane' }]}
      />
      <FormButton>Dodaj wolontariusza</FormButton>
    </FormHOC>
  );
};
