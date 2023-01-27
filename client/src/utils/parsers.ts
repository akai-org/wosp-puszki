import { currencies } from '@utils/types';

export const parseMoney = (money: number | string, currency: currencies): string => {
  const formatter = new Intl.NumberFormat('pl-PL', {
    currency: currency.toUpperCase(),
    style: 'currency',
  });

  let sanitizedMoney: number;

  if (typeof money === 'string') {
    sanitizedMoney = parseInt(money) as number;
  } else {
    sanitizedMoney = money;
  }

  return formatter.format(sanitizedMoney).replace('GBP', '£').replace('USD', '$');
};
