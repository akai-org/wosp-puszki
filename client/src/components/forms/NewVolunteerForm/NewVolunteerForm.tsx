import React, { useState } from 'react';
import { Typography } from 'antd';
import { FormButton, FormInput, FormWrapper } from '@/components';
import {
  APIManager,
  FIRST_NAME_REQUIRED,
  ID_NUMBER_REQUIRED,
  LAST_NAME_REQUIRED,
  fetcher,
  recognizeError,
} from '@/utils';
import type { IdNumber } from '@/utils';
import { useForm } from 'antd/lib/form/Form';
import type { FormMessage } from '@/utils';
import { useMutation } from '@tanstack/react-query';

interface NewVolunteerValues extends IdNumber {
  firstName: string;
  lastName: string;
  collectorIdentifier: number;
}

export const NewVolunteerForm = () => {
  const title = (
    <>
      Dodaj wolontariusza
      <Typography.Text type="secondary"> ( tego z Puszką )</Typography.Text>
    </>
  );

  const [form] = useForm();
  const [message, setMessage] = useState<FormMessage | undefined>();

  const mutation = useMutation({
    mutationFn: (values: NewVolunteerValues) =>
      fetcher(APIManager.addCollectorURL, {
        method: 'POST',
        body: {
          firstName: values.firstName,
          lastName: values.lastName,
          collectorIdentifier: values.collectorIdentifier,
        },
      }),

    onSuccess: () => {
      setMessage({ type: 'success', content: 'Pomyślnie dodano wolontariusza' });
      form.resetFields();
    },

    onError: (error: unknown) =>
      setMessage({
        type: 'error',
        content: recognizeError(error),
      }),
  });

  const onSubmit = (values: NewVolunteerValues) => {
    mutation.mutate(values);
  };

  return (
    <FormWrapper
      form={form}
      onFinish={onSubmit}
      label={title}
      name="newVolunteerForm"
      disabled={mutation.isLoading}
      message={message}
    >
      <FormInput
        label="Numer identyfikatora"
        rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
        name="collectorIdentifier"
      />
      <FormInput
        label="Imię"
        rules={[{ required: true, message: FIRST_NAME_REQUIRED }]}
        name="firstName"
      />
      <FormInput
        label="Nazwisko"
        name="lastName"
        rules={[{ required: true, message: LAST_NAME_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit" isLoading={mutation.isLoading}>
        Dodaj wolontariusza
      </FormButton>
    </FormWrapper>
  );
};
