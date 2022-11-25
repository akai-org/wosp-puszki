import React, { FC } from 'react';
import { Button, Form, ButtonProps } from 'antd';
import s from './FormButton.module.less';

interface Props extends ButtonProps {
  buttonText: string;
}

export const FormButton: FC<Props> = ({ buttonText, ...rest }) => {
  return (
    <Form.Item>
      <Button {...rest} className={s.submitBtn}>
        {buttonText}
      </Button>
    </Form.Item>
  );
};
