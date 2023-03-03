import { BoxToSettleForm } from '@/components';
import s from './SettleBoxPage.module.less';

export const SettleBoxPage = () => {
  return (
    <section className={s.container}>
      <BoxToSettleForm />
    </section>
  );
};
