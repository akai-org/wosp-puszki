import React, { FC } from 'react';
import { Select, Form } from 'antd';
import type { FormItemProps, SelectProps } from 'antd';
import type { VolunteerType } from '@/utils';
import s from './FormSelect.module.less';

type Props = FormItemProps & SelectProps<VolunteerType>;

export const FormSelect: FC<Props> = ({ ...rest }) => {
  return (
    <Form.Item className={s.formItem} {...rest}>
      <Select className={s.select} {...rest} />
    </Form.Item>
  );
};
