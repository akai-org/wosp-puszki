import s from './DisplayPage.module.less';
import { Space, Typography } from 'antd';
import samorzadLogo from '@assets/samorząd-logo.svg';
import finalLogo from '@assets/logo_final.png';
import akaiLogo from '@assets/akai-logo.svg';
import collected from '@assets/collected-text.svg';
import { MapController } from '@components/Layout/MapController/MapController';

export const DisplayPage = () => {
  const collectedMoney = '45 823,26';

  return (
    <Space direction="horizontal" className={s.wrapper}>
      <section className={s.moneyDataContainer}>
        <article className={s.logosContainer}>
          <img src={samorzadLogo} alt="" />
          <img src={finalLogo} alt="" />
          <img src={akaiLogo} alt="" />
        </article>
        <img height={80} src={collected} alt="" />
        <Typography.Title className={s.collectedText}>
          <span>{collectedMoney}</span>
          zł
        </Typography.Title>
      </section>
      <section>
        <MapController />
      </section>
    </Space>
  );
};
