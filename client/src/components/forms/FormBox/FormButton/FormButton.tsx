import React, { FC } from 'react';
import { Button, Form } from 'antd';
import type { ButtonProps, FormItemProps } from 'antd';
import s from './FormButton.module.less';

type Props = ButtonProps & FormItemProps;

export const FormButton: FC<Props> = ({
  onClick,
  htmlType = 'submit',
  type = 'primary',
  children,
  ...rest
}) => {
  return (
    <Form.Item className={s.formItem} {...rest}>
      <Button
        htmlType={htmlType}
        onClick={onClick}
        type={type}
        className={s.submitBtn}
        {...rest}
      >
        {children}
      </Button>
    </Form.Item>
  );
};
