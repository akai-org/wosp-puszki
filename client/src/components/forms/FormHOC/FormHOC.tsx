import s from './FormHOC.module.less';
import { Card, Form, FormProps, Typography } from 'antd';
import { FC, PropsWithChildren, ReactNode } from 'react';

interface Props extends Omit<FormProps, 'children' | 'title'>, PropsWithChildren {
  title?: ReactNode;
  formTitle?: FormProps['title'];
}

export const FormHOC: FC<Props> = ({ formTitle, title, children, ...rest }) => {
  return (
    <section className={s.container}>
      <Typography.Text className={s.title}>{title}</Typography.Text>
      <Card size="small" className={s.card}>
        <Form title={formTitle} {...rest} className={s.form}>
          {children}
        </Form>
      </Card>
    </section>
  );
};
