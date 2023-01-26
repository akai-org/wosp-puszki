import React, { Dispatch, SetStateAction } from 'react';
import { useState } from 'react';
import { Space, Typography } from 'antd';
import s from './GiveBoxForm.module.less';
import {
  APIManager,
  fetcher,
  ID_NUMBER_REQUIRED,
  NetworkError,
  TYPE_OF_BOX_REQUIRED,
} from '@/utils';

import { FormWrapper, FormInput, FormSelect, FormButton } from '@/components';
import { useMutation } from '@tanstack/react-query';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { useForm } from 'antd/es/form/Form';

const { Text } = Typography;

type FormInput = {
  id_number: string | number;
  box_type: 'box' | 'case';
};

function handleError(
  error: unknown,
  setError: Dispatch<SetStateAction<string | undefined>>,
) {
  if (error instanceof NetworkError) {
    handleNetworkError(error);
  } else {
    handleDefaultError();
  }

  function handleDefaultError() {
    if (typeof error === 'string') {
      setError(error);
    } else {
      setError('Wystąpił nieznany błąd');
    }
  }

  function handleNetworkError(error: NetworkError) {
    const errorData = JSON.parse(error.message);

    if (typeof errorData === 'object' && errorData['error']) {
      handlerErrorMessage();
    }
    function handlerErrorMessage() {
      const errorMessage = errorData.error;
      if (errorMessage === 'Attempt to read property "identifier" on null') {
        setError('Podano nieprawidłowy identyfikator');
      } else {
        setError(errorMessage);
      }
    }
  }
}

export const GiveBoxForm = () => {
  const [error, setError] = useState<string | undefined>();
  const [form] = useForm();
  const mutation = useMutation({
    mutationFn: (volunteerId: number) =>
      fetcher(APIManager.giveBoxURL(volunteerId), { method: 'POST' }),
    onError: (error) => handleError(error, setError),
    onSuccess: (data) => form.resetFields(),
  });

  const onFinish = (values: FormInput) => {
    let volunteerId = values.id_number;
    if (typeof volunteerId === 'string') {
      volunteerId = parseInt(volunteerId);
    }
    mutation.mutate(volunteerId);
    setError(undefined);
  };

  return (
    <FormWrapper
      form={form}
      label="Wydawanie Puszki"
      name="giveBoxForm"
      onFinish={onFinish}
      errorMessage={error}
      disabled={mutation.isLoading}
    >
      <Space className={s.formInputs}>
        <Space className={s.inputField} size={0}>
          <Text className={s.inputFieldName}>Numer Identyfikatora: </Text>
          <FormInput
            name="id_number"
            className={s.input}
            rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
          />
        </Space>
        <FormSelect
          name="box_type"
          placeholder="Wybierz rodzaj"
          options={[
            {
              value: 'box',
              label: 'Puszka',
            },
            {
              value: 'case',
              label: 'Skarbonka',
            },
          ]}
          rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
        />
      </Space>
      <FormButton htmlType="submit" type="primary">
        {mutation.isLoading ? <Spinner /> : 'Dodaj Puszkę'}
      </FormButton>
    </FormWrapper>
  );
};
