import { Space } from 'antd';
import s from './BottomContent.module.less';
import { Heart } from '@components/Display/MoneyDisplay';
import { Footer } from '@components/Display/MoneyDisplay/BottomContent/Footer/Footer';
import { FC } from 'react';
import { ExchangeRates } from '@pages/DisplayPage';

interface Props {
  availableStations: number;
  volunteersAmount: number;
  exchangeRates: ExchangeRates;
}

export const BottomContent: FC<Props> = ({
  volunteersAmount,
  availableStations,
  exchangeRates,
}) => {
  return (
    <Space className={s.bottomSection} align="center" direction="vertical">
      <Space className={s.heartsWrapper} align="center">
        <Heart count={volunteersAmount}>
          <div>Wolontariuszy</div>
        </Heart>
        <Heart count={availableStations}>
          <div>Dostępne</div>
          <div>Stanowiska</div>
        </Heart>
      </Space>
      <Footer exchangeRates={exchangeRates} />
    </Space>
  );
};
