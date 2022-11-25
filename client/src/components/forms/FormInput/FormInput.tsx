import React, { FC } from 'react';
import { Form, Input, FormItemProps, InputProps } from 'antd';
import s from './FormInput.module.less';

interface Props
  extends Omit<FormItemProps, 'name' | 'children' | 'onReset' | 'status'>,
    Omit<InputProps, 'name' | 'children' | 'onReset' | 'status'> {
  isPassword?: boolean;
  formItemStatus?: FormItemProps['status'];
  formItemName?: FormItemProps['name'];
  formItemOnReset?: FormItemProps['onReset'];
  inputName?: InputProps['name'];
  inputOnReset?: InputProps['onReset'];
  inputStatus?: InputProps['status'];
}

export const FormInput: FC<Props> = ({
  inputName,
  inputOnReset,
  inputStatus,
  formItemOnReset,
  formItemName,
  formItemStatus,
  isPassword,
  ...rest
}) => {
  return (
    <Form.Item
      onReset={formItemOnReset}
      status={formItemStatus}
      name={formItemName}
      {...rest}
    >
      {isPassword ? (
        <Input.Password
          status={inputStatus}
          name={inputName}
          onReset={inputOnReset}
          className={s.input}
        />
      ) : (
        <Input
          status={inputStatus}
          name={inputName}
          onReset={inputOnReset}
          className={s.input}
          {...rest}
        />
      )}
    </Form.Item>
  );
};
