import s from './DisplayPage.module.less';
import { Space } from 'antd';
import { MapDisplay } from '@components/Display';
import { MoneyDisplay } from '@components/Display/MoneyDisplay/MoneyDisplay';
import { useState } from 'react';
import { volunteerStatusClass } from '@/utils';

export type Amounts = {
  total: number;
  pln: number;
  euro: number;
  pound: number;
  dollar: number;
};

export type ExchangeRates = { euro: number; pound: number; dollar: number };

export interface IDisplayPageContent {
  stations: Record<number, volunteerStatusClass>;
  amounts: Amounts;
  volunteersAmount: number;
  availableStations: number;
  exchangeRates: ExchangeRates;
}

const initialStations: Record<number, volunteerStatusClass> = {};
Array.from(Array(28)).forEach(
  (el, index) => (initialStations[index + 1] = 'volunteer-occupied'),
);

export const DisplayPage = () => {
  const [vals, setVals] = useState<IDisplayPageContent>({
    amounts: { dollar: 0, euro: 0, pln: 0, pound: 0, total: 0 },
    availableStations: 0,
    exchangeRates: { euro: 0, pound: 0, dollar: 0 },
    volunteersAmount: 0,
    stations: initialStations,
  });

  // useEffect(() => {
  //   fetcher<IDisplayPageContent>((APIManager.baseAPIRUrl = '/some/path/to/data'), {
  //     public: true,
  //   })
  //     .then((data) => setVals(data))
  //     .catch((e) => console.log(e));
  // }, []);

  return (
    <div className={s.wrapper}>
      <div className={s.waves}></div>
      <Space direction="horizontal" className={s.innerWrapper}>
        <MoneyDisplay
          exchangeRates={vals.exchangeRates}
          volunteersAmount={vals.volunteersAmount}
          availableStations={vals.availableStations}
          amounts={vals.amounts}
        />
        <MapDisplay stations={vals.stations} />
      </Space>
    </div>
  );
};
