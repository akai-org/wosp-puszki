import s from './FormWrapper.module.less';
import { Card, Form, Space, Typography } from 'antd';
import type { FormProps } from 'antd';
import type { FC, ReactNode } from 'react';
import { FormError } from '../FormError';
interface Props extends FormProps {
  label?: ReactNode;
  borderColor?: ReactNode;
  errorMessage?: ReactNode;
  children: ReactNode;
}

export const FormWrapper: FC<Props> = ({
  borderColor = 'red',
  errorMessage,
  label,
  children,
  ...rest
}) => {
  const typeOfBorder = () => {
    if (borderColor == 'black') {
      return s.blackBorderCard;
    }
    return s.card;
  };

  return (
    <Space direction="vertical" align="center">
      <Space.Compact direction="vertical" block={true}>
        <Typography.Text className={s.title}>{label}</Typography.Text>
        <Card size="small" className={errorMessage ? s.errorBorder : typeOfBorder()}>
          <Form className={s.form} {...rest}>
            {children}
          </Form>
        </Card>
        {errorMessage && <FormError message={errorMessage} />}
      </Space.Compact>
    </Space>
  );
};
