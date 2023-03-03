import s from './FormWrapper.module.less';
import { Card, Form, Space, Typography } from 'antd';
import type { FormProps } from 'antd';
import type { FC, ReactNode } from 'react';
import { FormError } from '../FormError';
import { FormMessage } from '@/utils';
interface Props extends FormProps {
  label?: ReactNode;
  borderColor?: ReactNode;
  message?: FormMessage;
  children: ReactNode;
}

export const FormWrapper: FC<Props> = ({
  borderColor = 'red',
  message,
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

  const messageBorderStyle =
    message?.type === 'success' ? s.successBorder : s.errorBorder;

  return (
    <Space direction="vertical" align="center">
      <Space.Compact direction="vertical" block={true}>
        <Typography.Text className={s.title}>{label}</Typography.Text>
        <Card size="small" className={message ? messageBorderStyle : typeOfBorder()}>
          <Form className={s.form} {...rest}>
            {children}
          </Form>
        </Card>
        {message && <FormError message={message} />}
      </Space.Compact>
    </Space>
  );
};
