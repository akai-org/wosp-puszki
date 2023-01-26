import { currencies } from '@utils/types';

export const parseMoney = (money: number, currency: currencies): string => {
  const formatter = new Intl.NumberFormat('pl-PL', {
    currency: currency.toUpperCase(),
    style: 'currency',
  });
  return formatter.format(money).replace('GBP', '£').replace('USD', '$');
};
