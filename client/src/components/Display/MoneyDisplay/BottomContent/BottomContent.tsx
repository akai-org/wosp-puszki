import { Space } from 'antd';
import s from './BottomContent.module.less';
import { Heart } from '@components/Display/MoneyDisplay';
import { Footer } from '@components/Display/MoneyDisplay/BottomContent/Footer/Footer';
import { stationState, useAmountsQuery, useStationsQuery } from '@/utils';

export const BottomContent = () => {
  const { data } = useAmountsQuery();
  const { data: stationsData } = useStationsQuery();
  console.log(stationsData);
  const availableStations = stationsData.filter(
    (station) => station.st === stationState.available,
  ).length;

  return (
    <Space className={s.bottomSection} align="center" direction="vertical">
      <Space className={s.heartsWrapper} align="center">
        <Heart count={data.collectors_in_city}>
          <div>Wolontariuszy</div>
        </Heart>
        <Heart count={availableStations}>
          <div>Dostępne</div>
          <div>Stanowiska</div>
        </Heart>
      </Space>
      <Footer exchangeRates={data.rates} />
    </Space>
  );
};
