import { InputNumber, Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title, Text } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';
import { FormButton } from '@/components';
import TextArea from 'antd/lib/input/TextArea';
import { AmountsKeys, useDepositContext } from './DepositContext';
import { useNavigate } from 'react-router-dom';
import { useMutation } from '@tanstack/react-query';
import { APIManager, fetcher, useBoxContext } from '@/utils';

const moneyValues = {
  '1gr': 0.01,
  '2gr': 0.02,
  '5gr': 0.05,
  '10gr': 0.1,
  '20gr': 0.2,
  '50gr': 0.5,
  '1zl': 1,
  '2zl': 2,
  '5zl': 5,
  '10zl': 10,
  '20zl': 20,
  '50zl': 50,
  '100zl': 100,
  '200zl': 200,
  '500zl': 500,
  EUR: 4.71,
  GBP: 5.37,
  USD: 4.33,
};

export function sum(amounts: Record<AmountsKeys, number>) {
  let summ = 0;
  for (const key in amounts) {
    const moneyDen = key.split('_')[1];
    summ +=
      amounts[key as AmountsKeys] * moneyValues[moneyDen as keyof typeof moneyValues];
  }
  return summ;
}

export const DepositBoxForm = () => {
  const { boxData, setBoxData } = useDepositContext();
  const { boxIdentifier, collectorName, collectorIdentifier } = useBoxContext();
  console.log(boxIdentifier);
  const navigate = useNavigate();
  const mutation = useMutation({
    mutationFn: () =>
      fetcher(`${APIManager.baseAPIRUrl}/boxes/${boxIdentifier}`, {
        method: 'POST',
        body: { comment: boxData.comment, ...boxData.amounts },
      }),
    onSuccess: () => navigate('/liczymy/boxes/settle/4'),
  });

  const handleInputChange = (id: string, value: number | string) => {
    setBoxData((prevMoneyCollected) => {
      const newAmounts = {
        ...prevMoneyCollected.amounts,
        [id]: value as number,
      };
      return { ...prevMoneyCollected, amounts: newAmounts };
    });
  };

  const acc = sum(boxData.amounts);

  const handleSubmit = () => {
    console.log(boxData);
    mutation.mutate();
  };

  const handleCommentInput = (id: string, value: number | string) => {
    setBoxData((state) => {
      const amountsCopy = { ...state.amounts };
      return { amounts: amountsCopy, comment: value.toString() };
    });
  };

  return (
    <Content className={s.full}>
      <Title level={4} className={s.title}>
        Rozliczenie puszki wolontariusza {collectorName} ( {collectorIdentifier} ) ( ID
        puszki w bazie:
        {boxIdentifier} )
      </Title>
      <Space className={s.columns}>
        <DepositColumn>
          <InputNumberBox
            count={handleInputChange}
            denomination="1gr"
            value={Number((boxData.amounts['count_1gr'] * moneyValues['1gr']).toFixed(2))}
            id="count_1gr"
            df={boxData.amounts['count_1gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2gr"
            value={Number((boxData.amounts['count_2gr'] * moneyValues['2gr']).toFixed(2))}
            id="count_2gr"
            df={boxData.amounts['count_2gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5gr"
            value={Number((boxData.amounts['count_5gr'] * moneyValues['5gr']).toFixed(2))}
            id="count_5gr"
            df={boxData.amounts['count_5gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="10gr"
            value={Number(
              (boxData.amounts['count_10gr'] * moneyValues['10gr']).toFixed(2),
            )}
            id="count_10gr"
            df={boxData.amounts['count_10gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20gr"
            value={Number(
              (boxData.amounts['count_20gr'] * moneyValues['20gr']).toFixed(2),
            )}
            id="count_20gr"
            df={boxData.amounts['count_20gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50gr"
            value={Number(
              (boxData.amounts['count_50gr'] * moneyValues['50gr']).toFixed(2),
            )}
            id="count_50gr"
            df={boxData.amounts['count_50gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="1zł"
            value={Number((boxData.amounts['count_1zl'] * moneyValues['1zl']).toFixed(2))}
            id="count_1zl"
            df={boxData.amounts['count_1zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2zł"
            value={Number((boxData.amounts['count_2zl'] * moneyValues['2zl']).toFixed(2))}
            id="count_2zl"
            df={boxData.amounts['count_2zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5zł"
            value={Number((boxData.amounts['count_5zl'] * moneyValues['5zl']).toFixed(2))}
            id="count_5zł"
            df={boxData.amounts['count_5zl']}
          />
        </DepositColumn>
        <DepositColumn>
          <InputNumberBox
            count={handleInputChange}
            denomination="10zł"
            value={Number(
              (boxData.amounts['count_10zl'] * moneyValues['10zl']).toFixed(2),
            )}
            id="count_10zl"
            df={boxData.amounts['count_10zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20zł"
            value={Number(
              (boxData.amounts['count_20zl'] * moneyValues['20zl']).toFixed(2),
            )}
            id="count_20zl"
            df={boxData.amounts['count_20zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50zł"
            value={Number(
              (boxData.amounts['count_50zl'] * moneyValues['50zl']).toFixed(2),
            )}
            id="count_50zl"
            df={boxData.amounts['count_50zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="100zł"
            value={Number(
              (boxData.amounts['count_100zl'] * moneyValues['100zl']).toFixed(2),
            )}
            id="count_100zl"
            df={boxData.amounts['count_100zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="200zł"
            value={Number(
              (boxData.amounts['count_200zl'] * moneyValues['200zl']).toFixed(2),
            )}
            id="count_200zl"
            df={boxData.amounts['count_200zl']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="500zł"
            value={Number(
              (boxData.amounts['count_500zl'] * moneyValues['500zl']).toFixed(2),
            )}
            id="count_500zl"
            df={boxData.amounts['count_500zl']}
          />
          <Space className={s.sum}>
            <>Suma</>
            <>{acc.toFixed(2).toString() + ' zł'}</>
          </Space>
          <Space
            direction="vertical"
            size={10}
            align="center"
            className={s.submitContainer}
          >
            <FormButton type="primary" onClick={handleSubmit}>
              Rozlicz Puszkę
            </FormButton>
          </Space>
        </DepositColumn>
        <DepositColumn>
          <Space className={s.foreignContainer}>
            <Text>Euro ( EUR )</Text>
            <InputNumber
              addonBefore="+"
              defaultValue="0"
              type="number"
              className={s.inputNumber}
              id="amount_EUR"
              onChange={(value) => {
                handleInputChange('amount_EUR', Number(value));
              }}
            />
            <Text>
              {Number((boxData.amounts['amount_EUR'] * moneyValues['EUR']).toFixed(2))} zł
            </Text>
          </Space>
          <Space className={s.foreignContainer}>
            <Text className={s.foreignText}>
              Funt brytyjski <br />( GBP )
            </Text>
            <InputNumber
              addonBefore="+"
              defaultValue="0"
              type="number"
              className={s.inputNumber}
              id="amount_GBP"
              onChange={(value) => {
                handleInputChange('amount_GBP', Number(value));
              }}
            />
            <Text>
              {Number((boxData.amounts['amount_GBP'] * moneyValues['GBP']).toFixed(2))} zł
            </Text>
          </Space>
          <Space className={s.foreignContainer}>
            <Text>
              Dolar <br />
              amerykański <br />( USD )
            </Text>
            <InputNumber
              addonBefore="+"
              defaultValue="0"
              type="number"
              className={s.inputNumber}
              id="amount_USD"
              onChange={(value) => {
                handleInputChange('amount_USD', Number(value));
              }}
            />
            <Text>
              {Number((boxData.amounts['amount_USD'] * moneyValues['USD']).toFixed(2))} zł
            </Text>
          </Space>
          <Space className={s.other} direction={'vertical'}>
            <Text>Inne</Text>
            <TextArea
              id="other"
              onChange={(e) => {
                const { value } = e.target;
                handleCommentInput('comment', value);
              }}
            ></TextArea>
          </Space>
        </DepositColumn>
      </Space>
    </Content>
  );
};
