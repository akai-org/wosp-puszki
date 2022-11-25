import s from './FormHOC.module.less';
import { Card, Form, FormProps } from 'antd';
import { FC, PropsWithChildren } from 'react';

interface Props extends Omit<FormProps, 'children'>, PropsWithChildren {}

export const FormHOC: FC<Props> = ({ children, ...rest }) => {
  return (
    <Card size="small" className={s.card}>
      <Form {...rest} className={s.form}>
        {children}
      </Form>
    </Card>
  );
};
