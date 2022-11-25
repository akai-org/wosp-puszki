import s from './FormHOC.module.less';
import { Card, Form } from 'antd';
import { PropsWithChildren } from 'react';

interface Props<T> extends PropsWithChildren {
  submitHandler: ((values: T) => void) | undefined;
}

export const FormHOC = <T extends object>({ submitHandler, children }: Props<T>) => {
  return (
    <Card size="small" className={s.card}>
      <Form
        name="loginForm"
        layout="horizontal"
        onFinish={submitHandler}
        className={s.form}
      >
        {children}
      </Form>
    </Card>
  );
};
