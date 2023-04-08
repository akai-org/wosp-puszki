import React, { FC } from 'react';
import { Button, Form } from 'antd';
import type { ButtonProps, FormItemProps } from 'antd';
import s from './FormButton.module.less';
import { Spinner } from '@components/Layout/Spinner/Spinner';

type Props = ButtonProps & FormItemProps & { isLoading?: boolean };

export const FormButton: FC<Props> = ({
  onClick,
  htmlType = 'submit',
  type = 'primary',
  children,
  isLoading = false,
  disabled,
  ...rest
}) => {
  const disabledProp = disabled || isLoading;
  return (
    <Form.Item className={s.formItem} {...rest}>
      <Button
        htmlType={htmlType}
        onClick={onClick}
        type={type}
        className={s.submitBtn}
        disabled={disabledProp}
        {...rest}
      >
        {isLoading ? <Spinner /> : children}
      </Button>
    </Form.Item>
  );
};
