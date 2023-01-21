import s from './Logos.module.less';
import samorzadLogo from '@assets/samorząd-logo.svg';
import finalLogo from '@assets/logo_final.png';
import akaiLogo from '@assets/akai-logo.svg';

export const Logos = () => {
  return (
    <article className={s.logosContainer}>
      <img src={samorzadLogo} alt="" />
      <img src={finalLogo} alt="" />
      <img src={akaiLogo} alt="" />
    </article>
  );
};
