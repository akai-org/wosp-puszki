import React, { useState } from 'react';
import { Select, Form, InputNumber, Button } from 'antd';
import s from './CalculatorView.module.less';
import { CalculatorOutlined } from '@ant-design/icons';
import {
  ONE_GR_MASS_IN_GRAMS,
  TWO_GR_MASS_IN_GRAMS,
  FIVE_GR_MASS_IN_GRAMS,
  TEN_GR_MASS_IN_GRAMS,
  TWENTY_GR_MASS_IN_GRAMS,
  FIFTY_GR_MASS_IN_GRAMS,
  ONE_ZL_MASS_IN_GRAMS,
  TWO_ZL_MASS_IN_GRAMS,
  FIVE_ZL_MASS_IN_GRAMS,
} from '@/utils';

const options = [
  { value: ONE_GR_MASS_IN_GRAMS, label: '1gr' },
  { value: TWO_GR_MASS_IN_GRAMS, label: '2gr' },
  { value: FIVE_GR_MASS_IN_GRAMS, label: '5gr' },
  { value: TEN_GR_MASS_IN_GRAMS, label: '10gr' },
  { value: TWENTY_GR_MASS_IN_GRAMS, label: '20gr' },
  { value: FIFTY_GR_MASS_IN_GRAMS, label: '50gr' },
  { value: ONE_ZL_MASS_IN_GRAMS, label: '1zl' },
  { value: TWO_ZL_MASS_IN_GRAMS, label: '2zl' },
  { value: FIVE_ZL_MASS_IN_GRAMS, label: '5zl' },
];

export const CalculatorView = () => {
  const [value, setValue] = useState(0);
  const [show, setShow] = useState(false);

  const onFinish = (values: { mass: number; type: number }) => {
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
          <p>{Math.floor(value || 0)}</p>
        </div>
        <div className={s.bodyBottom}>
          <Form name="calculator" onFinish={onFinish} autoComplete="off">
            <Form.Item name="mass">
              <InputNumber min="0" step="0.01" addonAfter="g" placeholder="0" />
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
