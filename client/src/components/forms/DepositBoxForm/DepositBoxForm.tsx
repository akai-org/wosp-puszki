import { FormButton } from '@/components';
import { CalculatorView } from '@/components/Calculator/View/CalculatorView';
import {
  APIManager,
  AmountsKeys,
  FormMessage,
  MONEY_VALUES,
  ZLOTY_AMOUNTS_KEYS,
  fetcher,
  moneyValuesType,
  recognizeError,
  setStationUnavailable,
  sum,
  useAmountsQuery,
  useBoxContext,
  useDepositContext,
} from '@/utils';
import { Spinner } from '@components/Layout/Spinner/Spinner';
import { useMutation } from '@tanstack/react-query';
import { Form, Space, Typography } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import { Content } from 'antd/lib/layout/layout';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import s from './DepositBoxForm.module.less';

const { Title } = Typography;

//indexes that are used for splitting array of inputs to match our design
const moneySlice = {
  from_1gr: 0,
  to_5zl: 9,
  from_10zl: 9,
  to_500zl: 15,
  from_EUR: 15,
  to_USD: 19,
};

export const DepositBoxForm = () => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [total, setTotal] = useState(0);
  const { boxData, handleAmountsChange } = useDepositContext();
  const { boxIdentifier, collectorName, collectorIdentifier, isBoxExists } =
    useBoxContext();
  const navigate = useNavigate();
  const { data } = useAmountsQuery();

  if (!isBoxExists()) {
    navigate('/liczymy/boxes/settle');
  }
  setStationUnavailable();

  // TODO:
  // at the beggining values are set to 0, after the fetching data user have to manually change the amount of foreign money to see correct values
  // idea: context with money values, which start with opening login screen and updating data using useAmountsQuery
  //        or just remove value of foreign money, only amount

  useEffect(() => {
    const { USD, GBP, EUR } = data.rates;
    MONEY_VALUES['USD'] = USD;
    MONEY_VALUES['GBP'] = GBP;
    MONEY_VALUES['EUR'] = EUR;
  }, [data.rates]);

  useEffect(() => {
    setTotal(sum(boxData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES));
    console.log(MONEY_VALUES);
  }, [boxData]);

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

  const handleSubmit = () => {
    mutation.mutate();
  };

  const amounts: string[] = Object.keys(boxData['amounts']);
  const values: string[] = Object.keys(MONEY_VALUES);

  const inputs: JSX.Element[] = amounts.map((key, index) => {
    const value: string = values[index];
    const foreign = ['amount_EUR', 'amount_USD', 'amount_GBP'];
    return (
      <Form.Item style={{ marginBottom: 0 }} key={key}>
        <InputNumberBox
          count={handleAmountsChange}
          name={value}
          value={Number(
            (
              boxData.amounts[key as keyof Record<AmountsKeys, number>] *
              MONEY_VALUES[value as keyof moneyValuesType]
            ).toFixed(2),
          )}
          id={key}
          quantity={boxData.amounts[key as keyof Record<AmountsKeys, number>]}
          foreign={foreign.includes(key) ? true : false}
        />
      </Form.Item>
    );
  });

  return (
    <Content className={s.full}>
      <CalculatorView />
      <Form disabled={mutation.isLoading}>
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
              <>{total.toFixed(2).toString() + ' zł'}</>
            </Space>
          </DepositColumn>
          <DepositColumn foreign={true}>
            {inputs.slice(moneySlice['from_EUR'], moneySlice['to_USD']).map((input) => {
              return input;
            })}
            <Space className={s.other}>
              Inne
              <Form.Item style={{ marginBottom: 0 }}>
                <TextArea
                  className={s.textArea}
                  value={boxData['comment']}
                  onChange={(e) => {
                    const { value } = e.target;
                    handleAmountsChange('comment', value);
                  }}
                ></TextArea>
              </Form.Item>
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
