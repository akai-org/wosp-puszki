import React, { FC } from 'react';
import { Select, Form, FormItemProps, SelectProps } from 'antd';
import { VolunteerType } from '../../../utils/types';
import s from './FormSelect.module.less';
import { InputStatus } from 'antd/es/_util/statusUtils';
import { ValidateStatus } from 'antd/es/form/FormItem';

interface Props
  extends Omit<FormItemProps, 'status' | 'children'>,
    Omit<SelectProps<VolunteerType>, 'status' | 'children'> {
  selectStatus?: InputStatus;
  selectChildren?: React.ReactNode;
  formItemStatus?: ValidateStatus;
}

export const FormSelect: FC<Props> = ({ formItemStatus, selectChildren, ...rest }) => {
  return (
    <Form.Item status={formItemStatus} className={s.formItem} {...rest}>
      <Select className={s.select} {...rest}>
        {selectChildren}
      </Select>
    </Form.Item>
  );
};
