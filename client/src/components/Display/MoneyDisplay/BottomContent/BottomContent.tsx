import { Space } from 'antd';
import s from './BottomContent.module.less';
import { Heart } from '@components/Display/MoneyDisplay';
import { Footer } from '@components/Display/MoneyDisplay/BottomContent/Footer/Footer';

export const BottomContent = () => {
  const volunteersNumber = 5;
  const availableStations = 29;

  return (
    <Space className={s.bottomSection} align="center" direction="vertical">
      <Space className={s.heartsWrapper} align="center">
        <Heart count={volunteersNumber}>
          <div>Wolontariuszy</div>
        </Heart>
        <Heart count={availableStations}>
          <div>Dostępne</div>
          <div>Stanowiska</div>
        </Heart>
      </Space>
      <Footer />
    </Space>
  );
};
