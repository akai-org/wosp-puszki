import React, { FC } from 'react';
import { Select, Form, FormItemProps, SelectProps } from 'antd';
import { VolunteerType } from '../../../utils/types';
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
