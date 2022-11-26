import React, { FC } from 'react';
import { Select, Form } from 'antd';
import type { FormItemProps, SelectProps } from 'antd';
import type { VolunteerType } from '../../../utils';
import s from './FormSelect.module.less';

interface Props
  extends Omit<FormItemProps, 'status' | 'children'>,
    Omit<SelectProps<VolunteerType>, 'status' | 'children'> {
  selectStatus?: SelectProps['status'];
  formItemStatus?: FormItemProps['status'];
}

export const FormSelect: FC<Props> = ({ formItemStatus, ...rest }) => {
  return (
    <Form.Item status={formItemStatus} className={s.formItem} {...rest}>
      <Select className={s.select} {...rest} />
    </Form.Item>
  );
};
