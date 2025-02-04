import { FormButton, FormWrapper, FormInput, FormSelect } from '@/components';
import { Typography, Space } from 'antd';
import { Content } from 'antd/lib/layout/layout';
import s from './FindBoxForm.module.less';
import { useEffect, useState } from 'react';
import { useMutation } from '@tanstack/react-query';
import {
  useBoxContext,
  boxResponse,
  setStationAvailable,
  setStationUnavailable,
  APIManager,
  fetcher,
  FormMessage,
  ID_NUMBER_REQUIRED,
  TYPE_OF_BOX_REQUIRED,
  recognizeError,
  isFailedFetched,
  openNotification,
  NO_CONNECT_WITH_SERVER,
  useAuthContext,
  setStationUnknown,
  getIDfromUsername,
  createFullRoutePath,
  SETTLE_PROCESS_PATH,
  ACCEPT_BOX_PAGE_ROUTE,
  FIND_BOX_PAGE_ROUTE,
  FIND_BOX_BUSY_PAGE_ROUTE,
} from '@/utils';
import { useNavigate, useLocation } from 'react-router-dom';
import { useForm } from 'antd/es/form/Form';
import { StationAvalibility } from './StationAvalibility';

const { Text } = Typography;

const options = [
  {
    value: 0,
    label: 'Puszka Wolontariusza (-)',
  },
  {
    value: 10000,
    label: 'Puszka Firmowa (PF)',
  },
];

type FormInput = {
  id_number: string;
  box_type: 0 | 10000 | 20000;
};

export const FindBoxForm = () => {
  const navigate = useNavigate();
  const { username } = useAuthContext();

  const [message, setMessage] = useState<FormMessage | undefined>();
  const [form] = useForm();
  const { createBox } = useBoxContext();
  const location = useLocation();

  if (location.pathname === `${SETTLE_PROCESS_PATH}/${FIND_BOX_PAGE_ROUTE}`) {
    setStationAvailable();
  }
  if (location.pathname === `${SETTLE_PROCESS_PATH}/${FIND_BOX_BUSY_PAGE_ROUTE}`) {
    setStationUnavailable();
  }

  const mutation = useMutation<boxResponse, unknown, number | string, unknown>({
    mutationFn: (volunteerId: number | string) =>
      fetcher(APIManager.findBoxURL(volunteerId)),
    onError: (error) => {
      setMessage({ type: 'error', content: recognizeError(error) });
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
        !!data.is_special_box,
      );
      form.resetFields();
      // TODO: Probalby can get rid of setTimeout
      setTimeout(
        () => navigate(createFullRoutePath(SETTLE_PROCESS_PATH, ACCEPT_BOX_PAGE_ROUTE)),
        1000,
      );
    },
  });

  const onFinish = (values: FormInput) => {
    if (!isNaN(Number(values.id_number))) {
      if (values.box_type === 0) {
        mutation.mutate(values.id_number);
      } else {
        const volunteerId = parseInt(values.id_number) + values.box_type;
        mutation.mutate(volunteerId);
      }
      setMessage(undefined);
    } else {
      setMessage({ type: 'error', content: 'Podano nieprawidłowy identyfikator' });
    }
  };

  // Go to a break
  const {
    error: errorBreak,
    isError: isErrorBreak,
    isLoading: isLoadingBreak,
    isSuccess: isSuccessBreak,
    mutateAsync: mutateGoOnABreak,
  } = setStationUnknown(username as string);

  useEffect(() => {
    if (isErrorBreak && isFailedFetched(errorBreak))
      openNotification('error', NO_CONNECT_WITH_SERVER);

    if (isSuccessBreak) navigate(SETTLE_PROCESS_PATH);
  }, [errorBreak, isErrorBreak, isSuccessBreak, navigate]);

  const handleBreak = () => {
    // if u are admin then fast go through, You dont need to set station status
    if (isNaN(getIDfromUsername(username as string))) {
      navigate(SETTLE_PROCESS_PATH);
    } else {
      mutateGoOnABreak();
    }
  };

  return (
    <Content className={s.container}>
      <Content className={s.formContainer}>
        <FormWrapper
          form={form}
          onFinish={onFinish}
          name="boxToSettleForm"
          className={s.form}
          borderColor="black"
          label="Znajdź puszkę do rozliczenia"
          message={message}
          disabled={mutation.isLoading || isLoadingBreak}
          initialValues={{ box_type: 0 }}
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
              <FormButton
                variant={'form'}
                htmlType="submit"
                type="primary"
                isLoading={mutation.isLoading}
              >
                Wyszukaj puszkę
              </FormButton>
            </Space>
          </Space>
        </FormWrapper>
        <FormButton
          disabled={isLoadingBreak || mutation.isLoading}
          type="primary"
          onClick={handleBreak}
        >
          Nie chcę rozliczać dalej - przerwa
        </FormButton>
      </Content>
      <StationAvalibility />
    </Content>
  );
};
