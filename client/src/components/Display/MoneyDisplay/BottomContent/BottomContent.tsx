import { Space } from 'antd';
import s from './BottomContent.module.less';
import { Heart } from '@components/Display/MoneyDisplay';

export const BottomContent = () => {
  return (
    <Space className={s.bottomSection} direction="vertical">
      <Space className={s.heartsWrapper} align="center">
        <Heart count={1}>
          <div>Wolontariuszy</div>
        </Heart>
        <Heart count={2}>
          <div>Dostępne</div>
          <div>Stanowiska</div>
        </Heart>
      </Space>
    </Space>
  );
};
