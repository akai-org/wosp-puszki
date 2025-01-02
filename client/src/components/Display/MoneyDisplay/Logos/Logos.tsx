import s from './Logos.module.less';
import samorzadLogo from '@assets/samorząd-logo.svg';
import finalLogo from '@assets/logo_final.png';
import akaiLogo from '@assets/akai-logo.svg';

export const Logos = () => {
  return (
    <article className={s.logosContainer}>
      <img src={samorzadLogo} id="rescale" alt="" />
      <img src={finalLogo} id="rescale" alt="" />
      <img src={akaiLogo} id="rescale" alt="" />
    </article>
  );
};
