import { Checkbox, InputNumber, Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title, Text } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';
import { FormButton } from '../FormButton';
import TextArea from 'antd/lib/input/TextArea';
import { useState, ReactNode, useContext, useEffect } from 'react';
import { DepositContext } from './DepositContext';
import { useNavigate } from 'react-router-dom';

type denomination =
  | '1gr'
  | '2gr'
  | '5gr'
  | '10gr'
  | '20gr'
  | '50gr'
  | '1zł'
  | '2zł'
  | '5zł'
  | '10zł'
  | '20zł'
  | '50zł'
  | '100zł'
  | '200zł'
  | '500zł';

interface BoxData {
  volunteerId: number;
  boxId: number;
  plnAmount: Array<{
    name: denomination;
    quantity: number;
    multiplier: number;
  }>;
  foreignCurrency: Array<{
    name: string;
    amount: number;
  }>;
  others?: string;
  needsSave: boolean;
}

const dataBox: BoxData = {
  volunteerId: 123,
  boxId: 22,
  plnAmount: [
    {
      name: '1gr',
      quantity: 0,
      multiplier: 0.01,
    },
    {
      name: '2gr',
      quantity: 0,
      multiplier: 0.02,
    },
    {
      name: '5gr',
      quantity: 0,
      multiplier: 0.05,
    },
    {
      name: '10gr',
      quantity: 0,
      multiplier: 0.1,
    },
    {
      name: '20gr',
      quantity: 0,
      multiplier: 0.2,
    },
    {
      name: '50gr',
      quantity: 0,
      multiplier: 0.5,
    },
    {
      name: '1zł',
      quantity: 0,
      multiplier: 1,
    },
    {
      name: '2zł',
      quantity: 0,
      multiplier: 2,
    },
    {
      name: '5zł',
      quantity: 0,
      multiplier: 5,
    },
    {
      name: '10zł',
      quantity: 0,
      multiplier: 10,
    },
    {
      name: '20zł',
      quantity: 0,
      multiplier: 20,
    },
    {
      name: '50zł',
      quantity: 0,
      multiplier: 50,
    },
    {
      name: '100zł',
      quantity: 0,
      multiplier: 100,
    },
    {
      name: '200zł',
      quantity: 3,
      multiplier: 200,
    },
    {
      name: '500zł',
      quantity: 0,
      multiplier: 500,
    },
  ],
  foreignCurrency: [
    {
      name: 'Euro (EUR)',
      amount: 52,
    },
    {
      name: 'Funt brytyjski (GBP)',
      amount: 5,
    },
    {
      name: 'Dolar amerykański (USD)',
      amount: 100,
    },
  ],
  others: '',
  needsSave: false,
};

const defaultValue = {
  '1gr': 0,
  '2gr': 0,
  '5gr': 0,
  '10gr': 0,
  '20gr': 0,
  '50gr': 0,
  '1zł': 0,
  '2zł': 0,
  '5zł': 0,
  '10zł': 0,
  '20zł': 0,
  '50zł': 0,
  '100zł': 0,
  '200zł': 0,
  '500zł': 0,
  'Euro (EUR)': 0,
  'Funt brytyjski (GBP)': 0,
  'Dolar amerykański (USD)': 0,
  others: '',
};

const moneyValues = {
  '1gr': 0.01,
  '2gr': 0.02,
  '5gr': 0.05,
  '10gr': 0.1,
  '20gr': 0.2,
  '50gr': 0.5,
  '1zł': 1,
  '2zł': 2,
  '5zł': 5,
  '10zł': 10,
  '20zł': 20,
  '50zł': 50,
  '100zł': 100,
  '200zł': 200,
  '500zł': 500,
  eur: 4.71,
  gbp: 5.37,
  usd: 4.33,
};

export const DepositBoxForm = () => {
  // @ts-ignore
  const { data, setData } = useContext(DepositContext);
  const [moneyCollected, setMoneyCollected] = useState(defaultValue);
  const navigate = useNavigate();

  useEffect(() => {
    if (!data.needsSave) {
      setData(dataBox);
    } else {
      setMoneyCollected((prevMoneyCollected) => {
        // @ts-ignore
        data.plnAmount.forEach((val) => {
          // @ts-ignore
          prevMoneyCollected[val.name] = val.quantity;
        });
        // @ts-ignore
        data.foreignCurrency.forEach((val) => {
          // @ts-ignore
          prevMoneyCollected[val.name] = val.amount;
        });
        return {
          ...prevMoneyCollected,
          others: data.others,
        };
      });
    }
  }, []);

  function handleInputChange(id: string, value: number | string) {
    if (value >= 0) {
      setMoneyCollected((prevMoneyCollected) => ({ ...prevMoneyCollected, [id]: value }));
    } else if (id == 'others') {
      // @ts-ignore
      setMoneyCollected((prevMoneyCollected) => ({ ...prevMoneyCollected, [id]: value }));
    }
  }

  const collectedValues = Object.values(moneyCollected);
  const moneyVal = Object.values(moneyValues);
  const sum = moneyVal.reduce(
    (acc, curr_val, curr_i) => acc + Number(curr_val * Number(collectedValues[curr_i])),
    0,
  );

  function handleSubmit() {
    // @ts-ignore
    setData((prevData) => {
      // @ts-ignore
      const pln = prevData.plnAmount.map((obj) => {
        const { name } = obj;

        // @ts-ignore
        return {
          ...obj, // @ts-ignore
          quantity: moneyCollected[name],
        };
      });

      // @ts-ignore
      const foreign = prevData.foreignCurrency.map((obj) => {
        const { name } = obj;
        // @ts-ignore
        return {
          ...obj, // @ts-ignore
          amount: moneyCollected[name],
        };
      });

      return {
        ...prevData,
        plnAmount: pln,
        foreignCurrency: foreign,
        others: moneyCollected['others'],
        needsSave: true,
      };
    });
    navigate('/liczymy/boxes/settle/4');
  }

  return (
    <Content className={s.full}>
      <Title level={4} className={s.title}>
        Rozliczenie puszki wolontariusza Patrycja Majewski ( 123 ) ( ID puszki w bazie: 22
        )
      </Title>
      <Space className={s.columns}>
        <DepositColumn>
          <InputNumberBox
            count={handleInputChange}
            denomination="1gr"
            value={Number((moneyCollected['1gr'] * moneyValues['1gr']).toFixed(2))}
            id="1gr"
            df={moneyCollected['1gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2gr"
            value={Number((moneyCollected['2gr'] * moneyValues['2gr']).toFixed(2))}
            id="2gr"
            df={moneyCollected['2gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5gr"
            value={Number((moneyCollected['5gr'] * moneyValues['5gr']).toFixed(2))}
            id="5gr"
            df={moneyCollected['5gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="10gr"
            value={Number((moneyCollected['10gr'] * moneyValues['10gr']).toFixed(2))}
            id="10gr"
            df={moneyCollected['10gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20gr"
            value={Number((moneyCollected['20gr'] * moneyValues['20gr']).toFixed(2))}
            id="20gr"
            df={moneyCollected['20gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50gr"
            value={Number((moneyCollected['50gr'] * moneyValues['50gr']).toFixed(2))}
            id="50gr"
            df={moneyCollected['50gr']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="1zł"
            value={Number((moneyCollected['1zł'] * moneyValues['1zł']).toFixed(2))}
            id="1zł"
            df={moneyCollected['1zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2zł"
            value={Number((moneyCollected['2zł'] * moneyValues['2zł']).toFixed(2))}
            id="2zł"
            df={moneyCollected['2zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5zł"
            value={Number((moneyCollected['5zł'] * moneyValues['5zł']).toFixed(2))}
            id="5zł"
            df={moneyCollected['5zł']}
          />
        </DepositColumn>
        <DepositColumn>
          <InputNumberBox
            count={handleInputChange}
            denomination="10zł"
            value={Number((moneyCollected['10zł'] * moneyValues['10zł']).toFixed(2))}
            id="10zł"
            df={moneyCollected['10zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20zł"
            value={Number((moneyCollected['20zł'] * moneyValues['20zł']).toFixed(2))}
            id="20zł"
            df={moneyCollected['20zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50zł"
            value={Number((moneyCollected['50zł'] * moneyValues['50zł']).toFixed(2))}
            id="50zł"
            df={moneyCollected['50zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="100zł"
            value={Number((moneyCollected['100zł'] * moneyValues['100zł']).toFixed(2))}
            id="100zł"
            df={moneyCollected['100zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="200zł"
            value={Number((moneyCollected['200zł'] * moneyValues['200zł']).toFixed(2))}
            id="200zł"
            df={moneyCollected['200zł']}
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="500zł"
            value={Number((moneyCollected['500zł'] * moneyValues['500zł']).toFixed(2))}
            id="500zł"
            df={moneyCollected['500zł']}
          />
          <Space className={s.sum}>
            <>Suma</>
            <>{sum.toFixed(2).toString() + ' zł'}</>
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
              id="eur"
              onChange={(value) => {
                handleInputChange('Euro (EUR)', Number(value));
              }}
            />
            <Text>
              {Number((moneyCollected['Euro (EUR)'] * moneyValues['eur']).toFixed(2))} zł
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
              id="gbp"
              onChange={(value) => {
                handleInputChange('Funt brytyjski (GBP)', Number(value));
              }}
            />
            <Text>
              {Number(
                (moneyCollected['Funt brytyjski (GBP)'] * moneyValues['gbp']).toFixed(2),
              )}{' '}
              zł
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
              id="usd"
              onChange={(value) => {
                handleInputChange('Dolar amerykański (USD)', Number(value));
              }}
            />
            <Text>
              {Number(
                (moneyCollected['Dolar amerykański (USD)'] * moneyValues['usd']).toFixed(
                  2,
                ),
              )}{' '}
              zł
            </Text>
          </Space>
          <Space className={s.other} direction={'vertical'}>
            <Text>Inne</Text>
            <TextArea
              id="other"
              onChange={(e) => {
                const { value } = e.target;
                handleInputChange('others', value);
              }}
            ></TextArea>
          </Space>
        </DepositColumn>
      </Space>
    </Content>
  );
};
