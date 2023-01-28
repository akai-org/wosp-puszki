import React, { Dispatch, SetStateAction, useEffect } from 'react';
import { useState } from 'react';
import { Space, Typography } from 'antd';
import s from './GiveBoxForm.module.less';
import {
  APIManager,
  fetcher,
  FormMessage,
  GIVE_BOX_WRONG_ID_ERROR_RESPONSE,
  ID_NUMBER_REQUIRED,
  NetworkError,
  TYPE_OF_BOX_REQUIRED,
} from '@/utils';

import { FormWrapper, FormInput, FormSelect, FormButton } from '@/components';
import { useMutation } from '@tanstack/react-query';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { useForm } from 'antd/es/form/Form';

const { Text } = Typography;

const options = [
  {
    value: 0,
    label: 'Puszka Wolontariusza',
  },
  {
    value: 10000,
    label: 'Puszka Stacjonarna',
  },
  {
    value: 20000,
    label: 'Puszka Firmowa',
  },
];

type FormInput = {
  id_number: string;
  box_type: 0 | 10000 | 20000;
};

function handleError(
  error: unknown,
  setError: Dispatch<SetStateAction<FormMessage | undefined>>,
) {
  if (error instanceof NetworkError) {
    handleNetworkError(error);
  } else {
    handleDefaultError();
  }

  function handleDefaultError() {
    if (typeof error === 'string') {
      setError({ type: 'error', content: error });
    } else {
      setError({ type: 'error', content: 'Wystąpił nieznany błąd' });
    }
  }

  function handleNetworkError(error: NetworkError) {
    const errorData = JSON.parse(error.message);

    if (typeof errorData === 'object' && errorData['error']) {
      handlerErrorMessage();
    }
    function handlerErrorMessage() {
      const errorMessage = errorData.error;
      if (errorMessage === GIVE_BOX_WRONG_ID_ERROR_RESPONSE) {
        setError({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
      } else {
        setError({ type: 'error', content: errorMessage });
      }
    }
  }
}

export const GiveBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [form] = useForm();
  const mutation = useMutation<{ collectorIdentifier: number }, unknown, number, unknown>(
    {
      mutationFn: (volunteerId: number) =>
        fetcher(APIManager.giveBoxURL(volunteerId), { method: 'POST' }),
      onError: (error) => handleError(error, setMessage),
      onSuccess: (data) => {
        setMessage({
          type: 'success',
          content: `Pomyślnie wydano puszkę dla identyfikatora: ${data.collectorIdentifier}`,
        });
        form.resetFields();
      },
    },
  );

  const onFinish = (values: FormInput) => {
    const volunteerId = parseInt(values.id_number) + values.box_type;
    if (!isNaN(volunteerId)) {
      mutation.mutate(volunteerId);
      setMessage(undefined);
    } else {
      setMessage({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
    }
  };

  useEffect(() => {
    form.setFieldsValue({
      box_type: {
        value: 0,
        label: 'Puszka Wolontariusza',
      },
    });
  }, []);
  return (
    <FormWrapper
      form={form}
      label="Wydawanie Puszki"
      name="giveBoxForm"
      onFinish={onFinish}
      message={message}
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
          options={options}
          rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
        />
      </Space>
      <FormButton htmlType="submit" type="primary">
        {mutation.isLoading ? <Spinner /> : 'Dodaj Puszkę'}
      </FormButton>
    </FormWrapper>
  );
};
