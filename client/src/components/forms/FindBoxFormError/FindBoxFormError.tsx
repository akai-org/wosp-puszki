import { Typography } from 'antd';
import s from './FindBoxFormError.module.less';
import type { FormProps } from 'antd';
import type { FC, ReactNode } from 'react';
const { Text } = Typography;

interface Props extends FormProps {
  message?: ReactNode;
}

export const FindBoxFormError: FC<Props> = ({ message }) => {
  return <Text className={s.error}>{message}</Text>;
};
