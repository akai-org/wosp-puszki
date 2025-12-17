import { useState } from 'react';
import { Space, Typography } from 'antd';
import s from './GiveBoxForm.module.less';
import {
  APIManager,
  fetcher,
  FormMessage,
  ID_NUMBER_REQUIRED,
  BoxTypeFormInput,
  recognizeError,
  TYPE_OF_BOX_REQUIRED,
  boxTypeFormSelectOptions,
} from '@/utils';

import { FormWrapper, FormInput, FormSelect, FormButton } from '@/components';
import { useMutation } from '@tanstack/react-query';
import { useForm } from 'antd/es/form/Form';

const { Text } = Typography;

declare interface boxFromHelp { id: string | number, text: string };

export const GiveBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [form] = useForm();

  const mutation = useMutation({
    mutationFn: (boxForm: boxFromHelp) => fetcher(APIManager.giveBoxURL(boxForm.id), {
      method: 'POST', body: { additional_comment: boxForm.text }
    }),
    onError: (error) => {
      console.log(error);
      setMessage({ type: 'error', content: recognizeError(error) });
    },
    onSuccess: (data: any) => {
      setMessage({
        type: 'success',
        content: `Pomyślnie wydano puszkę dla identyfikatora: ${data.collectorIdentifier}`,

      });
      form.resetFields();
    },
  });

  const onFinish = (values: BoxTypeFormInput) => {
    if (!isNaN(Number(values.id_number))) {
      console.log(values);
      if (values.box_type === 0) {
        mutation.mutate({ id: values.id_number, text: values.additional_comment });
      } else {
        const volunteerId = parseInt(values.id_number) + values.box_type;
        mutation.mutate({ id: volunteerId, text: values.additional_comment });
      }
      setMessage(undefined);
    } else {
      setMessage({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
    }
  };

  return (
    <FormWrapper
      form={form}
      label="Wydawanie Puszki"
      name="giveBoxForm"
      onFinish={onFinish}
      message={message}
      disabled={mutation.isLoading}
      initialValues={{ box_type: 0 }}
    >
      <Space className={s.formInputs}>
        <Space className={s.inputField} size={0}>
          <Text className={s.inputFieldName}>Numer Identyfikatora: </Text>
          <FormInput
            // eslint-disable-next-line jsx-a11y/no-autofocus
            autoFocus
            name="id_number"
            className={s.input}
            rules={[{ required: true, message: ID_NUMBER_REQUIRED }]}
          />
        </Space>
        <Space className={s.inputField} size={0}>
          <Text className={s.inputFieldComment}>Uwagi dodatkowe: </Text>
          <FormInput
            // eslint-disable-next-line jsx-a11y/no-autofocus
            autoFocus
            name="additional_comment"
            className={s.input}
            rules={[{ required: false }]}
          />
        </Space>
        <FormSelect
          name="box_type"
          placeholder="Wybierz rodzaj"
          options={boxTypeFormSelectOptions}
          rules={[{ required: true, message: TYPE_OF_BOX_REQUIRED }]}
        />
      </Space>
      <FormButton htmlType="submit" type="primary" isLoading={mutation.isLoading}>
        Dodaj Puszkę
      </FormButton>
    </FormWrapper>
  );
};
