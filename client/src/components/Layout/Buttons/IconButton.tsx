import { Button } from 'antd';
import { ComponentProps, FC } from 'react';
import s from './IconButton.module.less';
import { ExportOutlined } from '@ant-design/icons';

type Props = ComponentProps<typeof Button>;

export const IconButton: FC<Props> = ({ children, ...rest }) => {
  return (
    <Button className={s.iconButton} {...rest}>
      <ExportOutlined />
      {children}
    </Button>
  );
};
