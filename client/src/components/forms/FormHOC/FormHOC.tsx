import s from './FormHOC.module.less';
import { Card, Form, FormProps, Typography } from 'antd';
import { FC, PropsWithChildren } from 'react';

interface Props extends Omit<FormProps, 'children'>, PropsWithChildren {
  title?: string;
}

export const FormHOC: FC<Props> = ({ title, children, ...rest }) => {
  return (
    <section className={s.container}>
      <Typography.Text className={s.title}>{title}</Typography.Text>
      <Card size="small" className={s.card}>
        <Form {...rest} className={s.form}>
          {children}
        </Form>
      </Card>
    </section>
  );
};
