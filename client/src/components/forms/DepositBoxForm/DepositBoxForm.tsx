import { Checkbox, InputNumber, Space, Typography } from 'antd';
import s from './DepositBoxForm.module.less';
const { Title, Text } = Typography;
import { DepositColumn } from '../DepositFormColumn';
import { InputNumberBox } from '../InputNumberBox';
import { Content } from 'antd/lib/layout/layout';
import { FormButton } from '../FormButton';
import TextArea from 'antd/lib/input/TextArea';
import { useState } from 'react';

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
  eur: 4.71,
  gbp: 5.37,
  usd: 4.33,
};

export const DepositBoxForm = () => {
  const [moneyCollected, setMoneyCollected] = useState({
    '1gr': 0,
    '2gr': 0,
    '5gr': 0,
    '10gr': 0,
    '20gr': 0,
    '50gr': 0,
    '1zl': 0,
    '2zl': 0,
    '5zl': 0,
    '10zl': 0,
    '20zl': 0,
    '50zl': 0,
    '100zl': 0,
    '200zl': 0,
    '500zl': 0,
    eur: 0,
    gbp: 0,
    usd: 0,
    other: '',
  });

  function handleInputChange(id: string, value: number | string) {
    setMoneyCollected((prevMoneyCollected) => ({ ...prevMoneyCollected, [id]: value }));
  }

  const collectedValues = Object.values(moneyCollected);
  const moneyVal = Object.values(moneyValues);
  const sum = moneyVal.reduce(
    (acc, curr_val, curr_i) => acc + Number(curr_val * Number(collectedValues[curr_i])),
    0,
  );

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
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2gr"
            value={Number((moneyCollected['2gr'] * moneyValues['2gr']).toFixed(2))}
            id="2gr"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5gr"
            value={Number((moneyCollected['5gr'] * moneyValues['5gr']).toFixed(2))}
            id="5gr"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="10gr"
            value={Number((moneyCollected['10gr'] * moneyValues['10gr']).toFixed(2))}
            id="10gr"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20gr"
            value={Number((moneyCollected['20gr'] * moneyValues['20gr']).toFixed(2))}
            id="20gr"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50gr"
            value={Number((moneyCollected['50gr'] * moneyValues['50gr']).toFixed(2))}
            id="50gr"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="1zł"
            value={Number((moneyCollected['1zl'] * moneyValues['1zl']).toFixed(2))}
            id="1zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="2zł"
            value={Number((moneyCollected['2zl'] * moneyValues['2zl']).toFixed(2))}
            id="2zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="5zł"
            value={Number((moneyCollected['5zl'] * moneyValues['5zl']).toFixed(2))}
            id="5zl"
          />
        </DepositColumn>
        <DepositColumn>
          <InputNumberBox
            count={handleInputChange}
            denomination="10zł"
            value={Number((moneyCollected['10zl'] * moneyValues['10zl']).toFixed(2))}
            id="10zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="20zł"
            value={Number((moneyCollected['20zl'] * moneyValues['20zl']).toFixed(2))}
            id="20zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="50zł"
            value={Number((moneyCollected['50zl'] * moneyValues['50zl']).toFixed(2))}
            id="50zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="100zł"
            value={Number((moneyCollected['100zl'] * moneyValues['100zl']).toFixed(2))}
            id="100zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="200zł"
            value={Number((moneyCollected['200zl'] * moneyValues['200zl']).toFixed(2))}
            id="200zl"
          />
          <InputNumberBox
            count={handleInputChange}
            denomination="500zl"
            value={Number((moneyCollected['500zl'] * moneyValues['500zl']).toFixed(2))}
            id="500zl"
          />
          <Space className={s.sum}>
            <>Suma</>
            <>{sum.toFixed(2).toString() + ' zł'}</>
          </Space>
          <Space
            direction="vertical"
            size={8}
            align="center"
            className={s.submitContainer}
          >
            <Checkbox>Potwierdzam poprawność danych</Checkbox>
            <FormButton htmlType="submit" type="primary">
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
                handleInputChange('eur', Number(value));
              }}
            />
            <Text>
              {Number((moneyCollected['eur'] * moneyValues['eur']).toFixed(2))} zł
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
                handleInputChange('gbp', Number(value));
              }}
            />
            <Text>
              {Number((moneyCollected['gbp'] * moneyValues['gbp']).toFixed(2))} zł
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
                handleInputChange('usd', Number(value));
              }}
            />
            <Text>
              {Number((moneyCollected['usd'] * moneyValues['usd']).toFixed(2))} zł
            </Text>
          </Space>
          <Space className={s.other} direction={'vertical'}>
            <Text>Inne</Text>
            <TextArea
              id="other"
              onChange={(e) => {
                const { value } = e.target;
                handleInputChange('other', value);
              }}
            ></TextArea>
          </Space>
        </DepositColumn>
      </Space>
    </Content>
  );
};
