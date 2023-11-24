import { FormButton } from '@/components';
import { CalculatorView } from '@/components/Calculator/CalculatorView';
import {
  APIManager,
  AmountsKeys,
  CHECKOUT_BOX_PAGE_ROUTE,
  FormMessage,
  MONEY_VALUES,
  SETTLE_PROCESS_PATH,
  ZLOTY_AMOUNTS_KEYS,
  createFullRoutePath,
  fetcher,
  moneyValuesType,
  recognizeError,
  setStationUnavailable,
  sum,
  useDepositContext,
  useGetBoxData,
} from '@/utils';
import { useMutation } from '@tanstack/react-query';
import { Form, Space, Typography } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import { Content } from 'antd/lib/layout/layout';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { DepositColumn } from '@/components';
import { InputNumberBox } from '@/components';
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

export interface DepositBoxFormProps {
  data?: null,
  editMode?: boolean
}

export const DepositBoxForm = ({ data, editMode }: DepositBoxFormProps) => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [total, setTotal] = useState(0);
  const { boxData, handleAmountsChange } = useDepositContext();
  const { boxIdentifier, collectorName, collectorIdentifier } = useGetBoxData();
  const navigate = useNavigate();

  setStationUnavailable();

  useEffect(() => {
    setTotal(sum(boxData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES));
  }, [boxData]);

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}`, {
        method: 'POST',
        body: { comment: boxData.comment, ...boxData.amounts },
      }),
    onSuccess: () =>
      navigate(createFullRoutePath(SETTLE_PROCESS_PATH, CHECKOUT_BOX_PAGE_ROUTE)),
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
          foreign={foreign.includes(key)}
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
              <>Suma ( tylko PLN )</>
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
                  disabled={mutation.isLoading}
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
          <FormButton
            type="primary"
            onClick={handleSubmit}
            isLoading={mutation.isLoading}
          >
            Rozlicz Puszkę
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
