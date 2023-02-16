import { Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';
import { FormButton } from '@/components';
import TextArea from 'antd/lib/input/TextArea';
import { useDepositContext } from './DepositContext';
import { Form, useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import {
  AmountsKeys,
  APIManager,
  fetcher,
  useAuthContext,
  useBoxContext,
  useSetStationUnavailableQuery,
  recognizeError,
  FormMessage,
  useAmountsQuery,
} from '@/utils';
import { CalculatorView } from '@/components/Calculator/View/CalculatorView';
import { useEffect, useState } from 'react';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { moneyValuesType, sum, moneyValues } from './Sum';
import { uid } from 'uid';

//indexes that are used for splitting array of inputs to match our design
const moneySlice = {
  from_1gr: 0,
  to_5zl: 9,
  from_10zl: 9,
  to_500zl: 15,
  from_EUR: 15,
  to_USD: 19,
};

const getIDs = () => {
  const arr = [];
  for (let i = moneySlice['from_1gr']; i < moneySlice['to_USD']; i++) {
    arr.push(uid());
  }
  return arr;
};

const IDs: string[] = getIDs();

export const DepositBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const { boxData, handleAmountsChange } = useDepositContext();
  const { boxIdentifier, collectorName, collectorIdentifier } = useBoxContext();
  const navigate = useNavigate();
  const { data } = useAmountsQuery();
  useEffect(() => {
    if (
      collectorName === null ||
      collectorIdentifier === null ||
      boxIdentifier === null
    ) {
      navigate('/liczymy/boxes/settle');
    }
  }, [boxIdentifier, collectorName, collectorIdentifier]);

  useEffect(() => {
    const { USD, GBP, EUR } = data.rates;
    moneyValues['USD'] = USD;
    moneyValues['GBP'] = GBP;
    moneyValues['EUR'] = EUR;
  }, [data.rates]);

  const { username } = useAuthContext();
  useSetStationUnavailableQuery(username);

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}`, {
        method: 'POST',
        body: { comment: boxData.comment, ...boxData.amounts },
      }),
    onSuccess: () => navigate('/liczymy/boxes/settle/4'),
    onError: (error) => {
      setMessage({ type: 'error', content: recognizeError(error) });
    },
  });

  const acc = sum(boxData.amounts);

  const handleSubmit = () => {
    mutation.mutate();
  };

  const amounts: string[] = Object.keys(boxData['amounts']);
  const values: string[] = Object.keys(moneyValues);
  console.log(values);
  const inputs: JSX.Element[] = amounts.map((key, index) => {
    const value: string = values[index];
    return (
      <InputNumberBox
        key={IDs[index]}
        count={handleAmountsChange}
        name={value}
        dis={mutation.isLoading}
        value={Number(
          (
            boxData.amounts[key as keyof Record<AmountsKeys, number>] *
            moneyValues[value as keyof moneyValuesType]
          ).toFixed(2),
        )}
        id={key}
        df={boxData.amounts[key as keyof Record<AmountsKeys, number>]}
      />
    );
  });

  return (
    <Content className={s.full}>
      <CalculatorView />
      <Form>
        <Title level={4} className={s.title}>
          Rozliczenie puszki wolontariusza {collectorName} ( {collectorIdentifier} ) ( ID
          puszki w bazie:
          {boxIdentifier} )
        </Title>
        <Space className={s.columns}>
          <DepositColumn>
            {inputs.slice(moneySlice['from_1gr'], moneySlice['to_5zl']).map((input) => {
              return input;
            })}
          </DepositColumn>
          <DepositColumn>
            {inputs
              .slice(moneySlice['from_10zl'], moneySlice['to_500zl'])
              .map((input) => {
                return input;
              })}
            <Space className={s.sum}>
              <>Suma</>
              <>{acc.toFixed(2).toString() + ' zł'}</>
            </Space>
          </DepositColumn>
          <DepositColumn foreign={true}>
            {inputs.slice(moneySlice['from_EUR'], moneySlice['to_USD']).map((input) => {
              return input;
            })}
            <Space className={s.other}>
              Inne
              <TextArea
                className={s.textArea}
                value={boxData['comment']}
                onChange={(e) => {
                  const { value } = e.target;
                  handleAmountsChange('comment', value);
                }}
              ></TextArea>
            </Space>
          </DepositColumn>
        </Space>
        <Space
          direction="vertical"
          size={10}
          align="center"
          className={s.submitContainer}
        >
          <FormButton type="primary" onClick={handleSubmit}>
            {mutation.isLoading ? <Spinner /> : 'Rozlicz Puszkę'}
          </FormButton>
        </Space>
        {message && (
          <div className={s.error}>
            <p>{message.content}</p>
          </div>
        )}
      </Form>
    </Content>
  );
};
