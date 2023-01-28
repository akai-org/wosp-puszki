import React, { useState } from 'react';
import { Select, Form, InputNumber, Button } from 'antd';
import s from './CalculatorView.module.less';
import { CalculatorOutlined } from '@ant-design/icons';
import {
  JEDEN_GR,
  DWA_GR,
  PIEC_GR,
  DZIESIEC_GR,
  DWADZIESCIA_GR,
  PIECDZIESIAT_GR,
  JEDEN_ZL,
  DWA_ZL,
  PIEC_ZL,
} from '@/utils';

const options = [
  { value: JEDEN_GR, label: '1gr' },
  { value: DWA_GR, label: '2gr' },
  { value: PIEC_GR, label: '5gr' },
  { value: DZIESIEC_GR, label: '10gr' },
  { value: DWADZIESCIA_GR, label: '20gr' },
  { value: PIECDZIESIAT_GR, label: '50gr' },
  { value: JEDEN_ZL, label: '1zl' },
  { value: DWA_ZL, label: '2zl' },
  { value: PIEC_ZL, label: '5zl' },
];

function round(num: number, decimalPlaces = 0) {
  num = Math.round(parseInt(num + 'e' + decimalPlaces));
  return Number(num + 'e' + -decimalPlaces);
}

export const CalculatorView = () => {
  const [value, setValue] = useState(0);
  const [show, setShow] = useState(false);

  const onFinish = (values: any) => {
    console.log('Success:', values);
    setValue((values.mass / values.type) * 100);
  };

  return (
    <div className={[s.calculator, show ? s.show : ''].join(' ')}>
      <div className={[s.iconBox, show ? s.show : ''].join(' ')}>
        <CalculatorOutlined className={s.icon} onClick={() => setShow(!show)} />
      </div>
      <div className={s.body}>
        <div className={s.bodyTop}>
          <p>Ilość monet:</p>
          <p>{round(value, 2)}</p>
        </div>
        <div className={s.bodyBottom}>
          <Form name="calculator" onFinish={onFinish} autoComplete="off">
            <Form.Item name="mass">
              <InputNumber min="0" step="0.01" addonAfter="g" />
            </Form.Item>
            <Form.Item name="type">
              <Select
                options={options}
                placeholder="Wybierz nominał"
                listHeight={128}
                className={s.select}
              />
            </Form.Item>
            <Button type="primary" htmlType="submit" className={s.calcButton}>
              Oblicz
            </Button>
          </Form>
        </div>
      </div>
    </div>
  );
};
