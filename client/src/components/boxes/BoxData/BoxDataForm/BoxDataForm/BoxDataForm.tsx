import { FormButton } from '@/components';
import { CalculatorView } from '@/components/Calculator/CalculatorView';
import {
  APIManager,
  AmountsKeys,
  CHECKOUT_BOX_PAGE_ROUTE,
  COUNTED_BOXES_PATH,
  FormMessage,
  MONEY_VALUES,
  SETTLE_PROCESS_PATH,
  ZLOTY_AMOUNTS_KEYS,
  createFullRoutePath,
  fetcher,
  moneyValuesType,
  recognizeError,
  sum,
  useDepositContext,
} from '@/utils';
import { useMutation } from '@tanstack/react-query';
import { Form, Space } from 'antd';
import TextArea from 'antd/lib/input/TextArea';
import { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { DepositColumn } from '@/components';
import { InputNumberBox } from '@/components';
import s from './BoxDataForm.module.less';

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
  boxId: string;
  editMode?: boolean;
}

export const DepositBoxForm = ({ boxId, editMode }: DepositBoxFormProps) => {
  const [message, setMessage] = useState<FormMessage | undefined>();
  const [total, setTotal] = useState(0);
  const { boxData, handleAmountsChange } = useDepositContext();
  const navigate = useNavigate();

  useEffect(() => {
    setTotal(sum(boxData, ZLOTY_AMOUNTS_KEYS, MONEY_VALUES));
  }, [boxData]);

  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/charityBoxes/${boxId}`, {
        method: 'PUT',
        body: { comment: boxData.comment, ...boxData.amounts },
      }),
    onSuccess: () =>
      navigate(
        editMode
          ? COUNTED_BOXES_PATH
          : createFullRoutePath(SETTLE_PROCESS_PATH, CHECKOUT_BOX_PAGE_ROUTE),
      ),
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
          value={
            (boxData.amounts[key as keyof Record<AmountsKeys, number>] as number) *
            MONEY_VALUES[value as keyof moneyValuesType]
          }
          id={key}
          quantity={boxData.amounts[key as keyof Record<AmountsKeys, number>]}
          foreign={foreign.includes(key)}
        />
      </Form.Item>
    );
  });
  return (
    <>
      <Form onFinish={handleSubmit} disabled={mutation.isLoading}>
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
              <>{total.toFixed(2) + ' zł'}</>
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
          <FormButton type="primary" isLoading={mutation.isLoading}>
            {editMode ? 'Zapisz' : 'Rozlicz Puszkę'}
          </FormButton>
        </Space>
        {message && (
          <div className={s.error}>
            <p>{message.content}</p>
          </div>
        )}
      </Form>
      <CalculatorView />
    </>
  );
};
