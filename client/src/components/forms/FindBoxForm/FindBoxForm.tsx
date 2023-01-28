import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import { Typography, Space, Button } from 'antd';
import { Content } from 'antd/lib/layout/layout';
import s from './FindBoxForm.module.less';
import React, { Dispatch, SetStateAction, useEffect } from 'react';
import { useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import { useBoxContext, boxResponse } from '@/utils';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { useNavigate } from 'react-router-dom';
import { useForm } from 'antd/es/form/Form';
import {
  APIManager,
  fetcher,
  FormMessage,
  GIVE_BOX_WRONG_ID_ERROR_RESPONSE,
  ID_NUMBER_REQUIRED,
  NetworkError,
  TYPE_OF_BOX_REQUIRED,
} from '@/utils';
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
    } else {
      setError({ type: 'error', content: 'Nie znaleziono puszki' });
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

export const FindBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [form] = useForm();
  const { createBox } = useBoxContext();
  const navigate = useNavigate();
  const mutation = useMutation<boxResponse, unknown, number, unknown>({
    mutationFn: (volunteerId: number) =>
      fetcher(APIManager.findBoxURL(volunteerId), { method: 'Get' }),
    onError: (error) => {
      handleError(error, setMessage);
    },
    onSuccess: (data) => {
      setMessage({
        type: 'success',
        content: `Pomyślnie znaleziono puszkę dla identyfikatora: ${data.collectorIdentifier}`,
      });
      createBox(
        [data.collector.firstName, data.collector.lastName].join(' '),
        data.collectorIdentifier,
        data.id.toString(),
      );
      form.resetFields();
      navigate('/liczymy/boxes/settle/2');
    },
  });

  const onFinish = (values: FormInput) => {
    const volunteerId = parseInt(values.id_number) + values.box_type;
    if (!isNaN(volunteerId)) {
      mutation.mutate(volunteerId);
      setMessage(undefined);
    } else {
      setMessage({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
    }
  };

  const handleBreak = () => {
    navigate('/liczymy/boxes/settle');
    return;
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
    <Content className={s.container}>
      <FormWrapper
        form={form}
        onFinish={onFinish}
        name="boxToSettleForm"
        className={s.form}
        borderColor="black"
        label="Znajdź puszkę do rozliczenia"
        message={message}
        disabled={mutation.isLoading}
      >
        <Space direction="vertical">
          <Space direction="vertical" className={s.form}>
            <Space className={s.inputContainer} size={0}>
              <Text className={s.text}>Numer Identyfikatora:</Text>
              <FormInput
                name="id_number"
                className={s.input}
                placeholder="Np. 123"
                rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
              />
            </Space>
            <FormSelect
              name="box_type"
              options={options}
              placeholder="Wybierz rodzaj"
              className={s.select}
              rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
            />
            <FormButton htmlType="submit" type="primary">
              {mutation.isLoading ? <Spinner /> : 'Wyszukaj puszkę'}
            </FormButton>
          </Space>
        </Space>
      </FormWrapper>
      <Button type="primary" className={s.break} onClick={handleBreak}>
        Nie chcę rozliczać dalej - przerwa
      </Button>
    </Content>
  );
};
