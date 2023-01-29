import { Space } from 'antd';
import s from '@components/Display/MoneyDisplay/BottomContent/Heart/Heart.module.less';
import { FC, PropsWithChildren } from 'react';

interface Props extends PropsWithChildren {
  count: number;
}
export const Heart: FC<Props> = ({ count, children }) => {
  return (
    <Space id="rescale" align="center" direction="vertical" className={s.heartContainer}>
      <section className={s.heart}>{count}</section>
      <div className={s.label}>{children}</div>
    </Space>
  );
};
