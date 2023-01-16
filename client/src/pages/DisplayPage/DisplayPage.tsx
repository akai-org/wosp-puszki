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
    <div className={s.wrapper}>
      <div className={s.waves}></div>
      <Space direction="horizontal" className={s.innerWrapper}>
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
          <Space className={s.currencies}>
            <Typography.Paragraph>
              <span>45 140,72 </span>
              zł
            </Typography.Paragraph>
            <Typography.Paragraph>
              <span>52,82 </span>€
            </Typography.Paragraph>
            <Typography.Paragraph>
              <span>44,79 </span>£
            </Typography.Paragraph>
            <Typography.Paragraph>
              <span>45,70 </span>$
            </Typography.Paragraph>
          </Space>
          <Space className={s.bottomSection} direction="vertical">
            <Space align="center">
              <Space align="center" direction="vertical" className={s.heartContainer}>
                <section className={s.heart}>1</section>
                <div>Wolontariuszy</div>
              </Space>
              <section>heart2</section>
            </Space>
          </Space>
        </section>
        <section>
          <MapController />
        </section>
      </Space>
    </div>
  );
};
