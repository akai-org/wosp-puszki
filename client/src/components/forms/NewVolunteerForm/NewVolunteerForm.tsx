import React, { useState } from 'react';
import { Typography } from 'antd';
import { FormButton, FormInput, FormSelect, FormWrapper } from '@/components';
import {
  APIManager,
  FIRST_NAME_REQUIRED,
  ID_NUMBER_REQUIRED,
  LAST_NAME_REQUIRED,
  TYPE_OF_BOX_REQUIRED,
  boxTypeFormSelectOptions,
  fetcher,
  recognizeError,
} from '@/utils';
import { useForm } from 'antd/lib/form/Form';
import type { BoxTypeFormInput, FormMessage } from '@/utils';
import { useMutation } from '@tanstack/react-query';

interface NewVolunteerValues extends Pick<BoxTypeFormInput, 'box_type'> {
  firstName: string;
  lastName: string;
  collectorIdentifier: string;
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
    const volunteerId = parseInt(values.collectorIdentifier) + values.box_type;
    values.collectorIdentifier = volunteerId.toString();
    console.log(values);
    if (!isNaN(volunteerId)) {
      mutation.mutate(values);
      setMessage(undefined);
    } else {
      setMessage({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
    }
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
      <FormSelect
        name="box_type"
        placeholder="Wybierz rodzaj"
        options={boxTypeFormSelectOptions}
        rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
      />
      <FormButton type="primary" htmlType="submit" isLoading={mutation.isLoading}>
        Dodaj wolontariusza
      </FormButton>
    </FormWrapper>
  );
};
