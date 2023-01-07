import s from './FormWrapper.module.less';
import { Card, Form, Space, Typography } from 'antd';
import type { FormProps } from 'antd';
import type { FC, ReactNode } from 'react';

interface Props extends FormProps {
  label?: ReactNode;
  borderColor?: ReactNode;
  children: ReactNode;
}

export const FormWrapper: FC<Props> = ({
  borderColor = 'red',
  label,
  children,
  ...rest
}) => {
  return (
    <Space direction="vertical" align="center">
      <Typography.Text className={s.title}>{label}</Typography.Text>
      <Card size="small" className={(borderColor = 'black' ? s.blackBorderCard : s.card)}>
        <Form className={s.form} {...rest}>
          {children}
        </Form>
      </Card>
    </Space>
  );
};
