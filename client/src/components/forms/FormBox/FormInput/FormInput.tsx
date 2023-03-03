import React, { FC } from 'react';
import { Form, Input } from 'antd';
import type { FormItemProps, InputProps } from 'antd';
import s from './FormInput.module.less';

interface CustomProps {
  isPassword?: boolean;
}

type Props = FormItemProps & InputProps & CustomProps;

export const FormInput: FC<Props> = ({ isPassword, ...rest }) => {
  return (
    <Form.Item {...rest}>
      {isPassword ? (
        <Input.Password className={s.input} {...rest} />
      ) : (
        <Input className={s.input} {...rest} />
      )}
    </Form.Item>
  );
};
