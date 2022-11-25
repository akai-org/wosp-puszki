import React, { FC } from 'react';
import { Button, Form, ButtonProps, FormItemProps } from 'antd';
import s from './FormButton.module.less';

interface Props
  extends Omit<ButtonProps, 'name' | 'onReset'>,
    Omit<FormItemProps, 'children' | 'name' | 'onReset'> {
  buttonName?: ButtonProps['name'];
  buttonOnReset?: ButtonProps['onReset'];
  formItemName?: FormItemProps['name'];
  formItemOnReset?: FormItemProps['onReset'];
}

export const FormButton: FC<Props> = ({
  buttonName,
  children,
  buttonOnReset,
  formItemOnReset,
  formItemName,
  htmlType,
  ...rest
}) => {
  return (
    <Form.Item
      onReset={formItemOnReset}
      name={formItemName}
      className={s.formItem}
      {...rest}
    >
      <Button
        htmlType={htmlType}
        onReset={buttonOnReset}
        name={buttonName}
        {...rest}
        className={s.submitBtn}
      >
        {children}
      </Button>
    </Form.Item>
  );
};
