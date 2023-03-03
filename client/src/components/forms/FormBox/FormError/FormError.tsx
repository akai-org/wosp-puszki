import { Typography } from 'antd';
import s from './FormError.module.less';
import type { FormProps } from 'antd';
import type { FC } from 'react';
import { FormMessage } from '@/utils';
const { Text } = Typography;

interface Props extends FormProps {
  message?: FormMessage;
}

export const FormError: FC<Props> = ({ message }) => {
  return (
    <Text className={message?.type === 'success' ? s.success : s.error}>
      {message?.content}
    </Text>
  );
};
