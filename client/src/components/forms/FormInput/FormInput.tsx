import React, { FC } from 'react';
import { Form, Input, FormItemProps } from 'antd';
import s from './FormInput.module.less';

interface Props extends FormItemProps {
  isPassword?: boolean;
}

export const FormInput: FC<Props> = ({ isPassword, ...rest }) => {
  return (
    <Form.Item {...rest}>
      {isPassword ? (
        <Input.Password className={s.input} />
      ) : (
        <Input className={s.input} />
      )}
    </Form.Item>
  );
};
